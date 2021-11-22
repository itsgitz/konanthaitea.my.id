<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Cart;
use App\Models\CartOrder;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\MenuStock;


class OrdersController extends Controller
{
    const PAYMENT_STATUS    = [
        'paid'      => 'Paid',
        'unpaid'    => 'Unpaid',
    ];

    const DELIVERY_STATUS   = [
        'waiting'       => 'Waiting',
        'confirmed'     => 'Confirmed',
        'on_progress'   => 'On Progress',
        'ready'         => 'Ready',
        'delivery'      => 'Delivery',
        'finish'        => 'Finish',
        'failed'        => 'Failed',
    ];

    const FINISH_CART_STATUS    = 'Finish';
    const ORDER_FINISH_MESSAGE  = 'Pesanan anda sedang diproses, harap menunggu status selanjutnya';
    const ORDER_MARK_AS_PAID    = 'mark_as_paid';

    public function getOnProgressOrderCount()
    {
        return Order::where('client_id', Auth::id())
            ->where('payment_status', '=', self::PAYMENT_STATUS['unpaid'])
            ->where('delivery_status', '<>', self::DELIVERY_STATUS['finish'])
            ->get()
            ->count();
    }

    //
    //Admin source code for order controller
    //
    public function adminIndex(Request $r)
    {
        $orders = DB::table('cart_orders')
            ->join('orders', 'cart_orders.order_id', '=', 'orders.id')
            ->join('carts', 'cart_orders.cart_id', '=', 'carts.id')
            ->join('menus', 'carts.menu_id', '=', 'menus.id')
            ->join('clients', 'carts.client_id', '=', 'clients.id')
            ->select(
                'orders.id AS order_id',
                'clients.id AS client_id',
                'clients.name AS client_name',
                'orders.payment_status AS order_payment_status',
                'orders.delivery_method AS order_delivery_method',
                'orders.delivery_status AS order_delivery_status',
                'orders.total_amount AS order_total_amount',
                'orders.created_at AS order_created_at'
            )
            ->distinct()
            ->orderBy('orders.created_at', 'DESC')
            ->get();

        
        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function adminShow(Request $r, $id)
    {
        $order      = Order::findOrFail($id);
        $cartOrders = $this->getCartOrders($id);


        return view('admin.orders.show', [
            'order' => $order,
            'cartOrders' => $cartOrders
        ]);
    }

    public function adminProcess(Request $r, $id)
    {
        $order = Order::find($id);

        switch($r->action) {
            case self::ORDER_MARK_AS_PAID:
                $order->payment_status = 'Paid';
                $order->save();


                return redirect()
                    ->route('admin_orders_show_get', [ 'id' => $id ]);
            break;

            case 'Mark as Finish':
            
                $order->order_status = 'Finish';
                $order->save();


                return redirect()
                    ->route('admin_orders_show_get', [ 'id' => $id ]);
            break;
        }
    }

    //
    //Client source code for order controller
    //
    //
    public function clientIndex(Request $r)
    {
        $cartOrders = DB::table('cart_orders')
            ->join('orders', 'cart_orders.order_id', '=', 'orders.id')
            ->join('carts', 'cart_orders.cart_id', '=', 'carts.id')
            ->join('menus', 'carts.menu_id', '=', 'menus.id')
            ->join('clients', 'carts.client_id', '=', 'clients.id')
            ->where('orders.client_id', '=', Auth::id())
            ->select(
                'menus.name AS menu_name',
                'menus.price AS menu_price',
                'carts.id AS cart_id',
                'carts.quantity AS cart_quantity',
                'carts.subtotal_amount AS cart_subtotal_amount',
                'orders.id AS order_id',
                'orders.total_amount AS order_total_amount',
                'orders.payment_status AS order_payment_status',
                'orders.payment_method AS order_payment_method',
                'orders.delivery_method AS delivery_method',
                'orders.delivery_status AS delivery_status',
                'orders.created_at AS order_created_at',
            )
            ->orderBy('orders.created_at', 'DESC')
            ->get();

        //Reset order data, remove duplicate order_id
        $orders = $this->setOrdersData($cartOrders);


        return view('client.orders.index', [
            'orders' => $orders
        ]);
    }

    //Client per order details
    public function clientShow(Request $r, $id)
    {
        $order  = Order::findOrFail($id);
        $carts  = $this->getCartOrders($id);

        return view('client.orders.show', [
            'order' => $order,
            'carts' => $carts
        ]);
    }

    //Client order process
    public function clientProcess(Request $r)
    {
        $r->validate(
            [
                'cart_delivery_method'  => ['required'],
                'cart_payment_method'   => ['required']
            ],
            [
                'cart_delivery_method.required' => 'Mohon untuk memilih metode pengiriman',
                'cart_payment_method.required'  => 'Mohon untuk memilih method pembayaran'
            ],
        );

        
        //Get order(id) after created an order
        $orderId = $this->saveOrder($r);
        $this->saveCartOrder($r, $orderId); 
        $this->saveMenuStock($r);
         
        return redirect()
            ->route('client_home')
            ->with('order_message', self::ORDER_FINISH_MESSAGE);
    }

    private function saveOrder(Request $r)
    {
        $order = new Order;
        $order->client_id       = Auth::id();
        $order->total_amount    = $r->cart_total_amount;
        $order->payment_status  = self::PAYMENT_STATUS['unpaid'];
        $order->payment_method  = $r->cart_payment_method;
        $order->delivery_method   = $r->cart_delivery_method;
        $order->delivery_status = self::DELIVERY_STATUS['waiting'];
        $order->save();

        return $order->id;
    }

    private function saveCartOrder(Request $r, $orderId)
    {
        foreach ($r->carts as $c) {
            //Change cart status to 'Finish'
            Cart::find($c['cart_id'])
                ->update(['status' => self::FINISH_CART_STATUS]);

            //Add data to cart_orders table
            CartOrder::create([
                'order_id'  => $orderId,
                'cart_id'   => $c['cart_id']
            ]);
        }
    }

    private function saveMenuStock(Request $r)
    {
        foreach ($r->carts as $c) {
            //Menu process, reduce quantity on menus table
            $menu = Menu::find($c['menu_id']);
            $menu->quantity = ( $menu->quantity - $c['cart_quantity'] );
            $menu->save();

            //Menu Stocks process, reduce quantity on menu_stocks table
            $menuStocks = MenuStock::where('menu_id', $c['menu_id'])->get();

            foreach ($menuStocks as $ms) {
                $stock = Stock::find($ms->stock_id);

                //Reduce quantity = order quantity * applied quantity (recipe)
                //Current quantity = Reduce quantity - current quantity
                $reduceQuantity = ( $c['cart_quantity'] * $ms->quantity );
                $currentQuantity = ( $stock->quantity - $reduceQuantity );

                $stock->quantity = $currentQuantity;
                $stock->save();
            }
        }
    }

    private function removeDuplicateOrders($cartOrders = [])
    {
        $orders = [];

        foreach ($cartOrders as $k => $co) {
            $orders[$k] = $co->order_id;
        }

        //Remove duplicate order_id
        $noDuplicateOrders = array_values(array_unique($orders));

        //Reset the orders
        $orders = [];
        foreach ( $noDuplicateOrders as $k => $orderId ) {
            $orders[$k]['id'] = $orderId;
            $orders[$k]['carts'] = [];
        }


        return $orders;
    }

    private function setOrdersData($cartOrders = [])
    {
        $orders = $this->removeDuplicateOrders($cartOrders);

        foreach ($orders as $k => $o) {
            foreach ($cartOrders as $co) {
                if ($o['id'] == $co->order_id) {

                    $orders[$k]['total_amount']     = $co->order_total_amount;
                    $orders[$k]['payment_status']   = $co->order_payment_status;
                    $orders[$k]['payment_method']   = $co->order_payment_method;
                    $orders[$k]['delivery_status']  = $co->delivery_status;
                    $orders[$k]['delivery_method']  = $co->delivery_method;
                    $orders[$k]['created_at']       = $co->order_created_at;

                    //Add cart data for each order_id
                    $cart = [
                        'id'                => $co->cart_id,
                        'menu_name'         => $co->menu_name,
                        'menu_price'        => $co->menu_price,
                        'quantity'          => $co->cart_quantity,
                        'subtotal_amount'   => $co->cart_subtotal_amount,
                    ];
                    array_push( $orders[$k]['carts'], $cart);
                }
            }
        }
        
        return $orders;
    }

    private function getCartOrders($id)
    {
        $cartOrders = DB::table('cart_orders')
            ->join('orders', 'cart_orders.order_id', '=', 'orders.id')
            ->join('carts', 'cart_orders.cart_id', '=', 'carts.id')
            ->join('menus', 'carts.menu_id', '=', 'menus.id')
            ->join('clients', 'carts.client_id', '=', 'clients.id')
            ->where('orders.id', '=', $id)
            ->select(
                'menus.name AS menu_name',
                'menus.price AS menu_price',
                'carts.quantity AS cart_quantity',
                'carts.subtotal_amount AS cart_subtotal_amount',
                'clients.name AS client_name',
            )
            ->get();

        
        return $cartOrders;
    }
}
