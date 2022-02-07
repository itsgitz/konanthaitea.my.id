<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Cart;
use App\Models\CartOrder;
use App\Models\Client;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\MenuStock;

use PDF;


class OrdersController extends Controller
{
    const PAYMENT_STATUS    = [
        'paid'      => 'Paid',
        'unpaid'    => 'Unpaid',
        'canceled'  => 'Canceled'
    ];

    const DELIVERY_STATUS   = [
        'waiting'       => 'Waiting',
        'confirmed'     => 'Confirmed',
        'on_progress'   => 'On Progress',
        'ready'         => 'Ready',
        'delivery'      => 'Delivery',
        'finish'        => 'Finish',
        'failed'        => 'Failed',
        'canceled'      => 'Canceled'
    ];

    const DELIVERY_METHOD = [
        'pickup'    => 'Pickup',
        'delivery'  => 'Delivery',
    ];

    const STOCK_STATUS = [
        'available'         => 'Available',
        'not_available'     => 'Not Available',
        'limited'           => 'Limited'
    ];

    const STOCK_ID = [
        'Mililiter' => 1,
        'Gram'      => 2,
        'Buah'      => 3,
    ];

    const MENU_STATUS = [
        'available'     => 'Available',
        'sold_out'      => 'Sold Out'
    ];

    const FINISH_CART_STATUS    = 'Finish';
    const ORDER_FINISH_MESSAGE  = 'Pesanan anda sedang diproses, harap menunggu status selanjutnya';

    const ADMIN_ORDER_PROCESS_MESSAGE = 'Berhasil memproses order';
    const ADMIN_ORDER_EXPORT_BY_DATE_ERROR = 'Data tidak ditemukan';


    public function getOnProgressOrderCount()
    {
        return Order::where('client_id', Auth::id())
            ->where(function($query) {
                $query->where('delivery_status', '<>', self::DELIVERY_STATUS['finish'])
                    ->where('delivery_status', '<>', self::DELIVERY_STATUS['ready'])
                    ->where('delivery_status', '<>', self::DELIVERY_STATUS['canceled'])
                    ->where('delivery_status', '<>', self::DELIVERY_STATUS['failed'])
                    ->orWhere('payment_status', self::PAYMENT_STATUS['unpaid']);
            })
            ->get()->count();
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
                'orders.payment_method AS order_payment_method',
                'orders.delivery_method AS order_delivery_method',
                'orders.delivery_status AS order_delivery_status',
                'orders.total_amount AS order_total_amount',
                'orders.fee AS fee',
                'orders.region AS region',
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
        $order                  = Order::findOrFail($id);
        $cartOrders             = $this->getCartOrders($id);
        $deliveryStatusOptions  = $this->setDeliveryStatusOptions($order);
        $paymentStatusOptions   = $this->setPaymentStatusOptions($order);
        $totalPrice             = $this->getTotalPriceFromSubtotalPrice($cartOrders);
        $client                 = Client::find($order->client_id)->first();

        $outOfStock = false;

        $emptyStocks = $this->getEmptyStocks($id);

        if ( $emptyStocks->isNotEmpty() ) {
            $outOfStock = true;
        }


        return view('admin.orders.show', [
            'client'            => $client,
            'order'             => $order,
            'cartOrders'        => $cartOrders,
            'deliveryStatus'    => $deliveryStatusOptions,
            'paymentStatus'     => $paymentStatusOptions,
            'outOfStock'        => $outOfStock,
            'emptyStocks'       => $emptyStocks,
            'totalPrice'        => $totalPrice
        ]);
    }

    public function adminProcess(Request $r, $id)
    {
        $r->validate(
            [
                'order_payment_status'  => ['required'],
                'order_delivery_status' => ['required'],
            ],
            [
                'order_payment_status.required'  => 'Mohon untuk memilih status pembayaran',
                'order_delivery_status.required' => 'Mohon untuk memilih status pengiriman',
            ]
        );


        $order = Order::find($id);
        $order->payment_status  = $r->order_payment_status;
        $order->delivery_status = $r->order_delivery_status;
        $order->save();

        // If order canceled
        if ( $r->order_delivery_status == 'Canceled' || $r->order_payment_status == 'Canceled' ) {

            if ( $r->order_payment_status == 'Canceled' ) {
                $canceledOrder = Order::find($id);

                if ( $canceledOrder->delivery_method == 'Delivery' ) {
                    $canceledOrder->delivery_status = 'Failed';
                } else {
                    $canceledOrder->delivery_status = 'Canceled';
                }
                $canceledOrder->save();
            }

            $getRecipes = DB::table('cart_orders')
                ->join('carts', 'cart_orders.cart_id', '=', 'carts.id')
                ->join('menus', 'carts.menu_id', '=', 'menus.id')
                ->join('menu_stocks', 'menus.id', '=', 'menu_stocks.menu_id')
                ->join('stocks', 'menu_stocks.stock_id', 'stocks.id')
                ->where('cart_orders.order_id', '=', $id)
                ->select(
                    'menus.name AS menu_name',
                    'stocks.id AS stock_id',
                    'stocks.name AS stock_name',
                    'menu_stocks.quantity AS recipe_quantity',
                )
                ->get();

            // rollback quantity on stocks table
            foreach ($getRecipes as $recipe) {
                $canceledStock = Stock::find($recipe->stock_id);

                $canceledQuantity = ($canceledStock->quantity + $recipe->recipe_quantity);
                $canceledStock->quantity = $canceledQuantity;

                if ($canceledStock->quantity > 0) {
                    switch ($canceledStock->stock_units_id) {
                    case self::STOCK_ID['Mililiter']:
                    case self::STOCK_ID['Gram']:
                        if ( $canceledQuantity <= 1000 ) {
                            $canceledStock->status = self::STOCK_STATUS['limited'];
                        } else {
                            $canceledStock->status = self::STOCK_STATUS['available'];
                        }
                        break;

                    case self::STOCK_ID['Buah']:
                        if ( $canceledQuantity <= 50 ) {
                            $canceledStock->status = self::STOCK_STATUS['limited'];
                        } else {
                            $canceledStock->status = self::STOCK_STATUS['available'];
                        }
                        break;
                    }
                }

                $canceledStock->save();
            }
        }

        return redirect()
            ->route('admin_orders_show_get', [ 'id' => $id ])
            ->with('admin_orders_process_message', self::ADMIN_ORDER_PROCESS_MESSAGE . ' #' . $id);
    }

    public function adminIndexExportToPdf(Request $r)
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
                'orders.payment_method AS order_payment_method',
                'orders.delivery_method AS order_delivery_method',
                'orders.delivery_status AS order_delivery_status',
                'orders.total_amount AS order_total_amount',
                'orders.created_at AS order_created_at'
            )
            ->whereBetween('orders.created_at', [$r->from, $r->to])
            ->distinct()
            ->orderBy('orders.created_at', 'DESC')
            ->get();

        if ($orders->isEmpty()) {
            return redirect()
                ->route('admin_orders_get')
                ->with('admin_order_export_by_date_error', self::ADMIN_ORDER_EXPORT_BY_DATE_ERROR);
        }

        view()->share('orders', $orders);
        $pdf = PDF::loadView('admin.exports.orders_pdf', [
            'orders'    => $orders,
            'from'      => $r->from,
            'to'        => $r->to,
        ]);

        $fileName = 'orders-' . date('d-m-Y') . '.pdf';

        return $pdf->download($fileName);
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
            'orders'    => $orders,
        ]);
    }

    //Client per order details
    public function clientShow(Request $r, $id)
    {
        $order      = Order::findOrFail($id);
        $carts      = $this->getCartOrders($id);
        $totalPrice = $this->getTotalPriceFromSubtotalPrice($carts);

        return view('client.orders.show', [
            'order'         => $order,
            'carts'         => $carts,
            'totalPrice'    => $totalPrice
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

        if ( $r->cart_delivery_method == 'Delivery' ) {
            $r->validate(
                [
                    'address'   => ['required', 'min:10'],
                    'phone'     => ['required', 'min:9', 'max:16'],
                    'region_value' => ['required']
                ],
                [
                    'address.required'  => 'Mohon untuk memasukan alamat anda',
                    'address.min'       => 'Alamat minimal harus 10 karakter',
                    'phone.required'    => 'Mohon untuk memasukan nomor HP atau telepon anda',
                    'phone.min'         => 'Nomor HP atau telepon minimal harus 9 karakter',
                    'phone.max'         => 'Nomor HP atau telepon maximal harus 16 karakter',
                    'region_value.required' => 'Mohon untuk memilih Kecamatan / Kelurahan'
                ]
            );
        }


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

        if ( isset($r->address) ) {
            $order->address = $r->address;
        }

        if ( isset($r->phone) ) {
            $order->phone_number = $r->phone;
        }

        if ( isset($r->region_value) ) {
            $regionFee = explode('|', $r->region_value)[0];
            $regionName = explode('|', $r->region_value)[1];
            $order->region = $regionName;
            $order->fee = $regionFee;
        }

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

            //Menu Stocks process, reduce quantity on menu_stocks table
            $menuStocks = MenuStock::where('menu_id', $c['menu_id'])->get();

            foreach ($menuStocks as $ms) {
                $stock = Stock::find($ms->stock_id);

                //Reduce quantity = order quantity * applied quantity (recipe)
                //Current quantity = Reduce quantity - current quantity
                $reduceQuantity = ( $c['cart_quantity'] * $ms->quantity );
                $currentQuantity = ( $stock->quantity - $reduceQuantity );

                switch ($stock->stock_units_id) {
                case self::STOCK_ID['Mililiter']:
                case self::STOCK_ID['Gram']:
                    if ( $currentQuantity <= 1000) {
                        $stock->status = self::STOCK_STATUS['limited'];
                    }
                    break;

                case self::STOCK_ID['Buah']:
                    if ( $currentQuantity <= 50 ) {
                        $stock->status = self::STOCK_STATUS['limited'];
                    }
                    break;
                }

                if ( $currentQuantity == 0 || $currentQuantity < 0 ) {
                    $stock->status = self::STOCK_STATUS['not_available'];
                    $menu->status = self::MENU_STATUS['sold_out'];
                }

                $stock->quantity = $currentQuantity;
                $stock->save();
            }

            $menu->save();

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
                'orders.address AS address',
                'orders.phone_number AS phone_number'
            )
            ->get();


        return $cartOrders;
    }

    private function getEmptyStocks($id)
    {
        $emptyStocks = DB::table('cart_orders')
            ->join('carts', 'cart_orders.cart_id', '=', 'carts.id')
            ->join('orders', 'cart_orders.order_id', '=', 'orders.id')
            ->join('menus', 'carts.menu_id', '=', 'menus.id')
            ->join('menu_stocks', 'menus.id', '=', 'menu_stocks.menu_id')
            ->join('stocks', 'menu_stocks.stock_id', '=', 'stocks.id')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->where('orders.id', '=', $id)
            ->where('stocks.status', '=', self::STOCK_STATUS['not_available'])
            ->select(
                'stocks.id AS stock_id',
                'stocks.name AS stock_name',
                'stocks.quantity AS stock_quantity',
                'stocks.status AS stock_status',
                'stock_units.name AS unit_name'
            )
            ->get();

        return $emptyStocks;
    }

    private function setPaymentStatusOptions($order)
    {
        $options = [];

        $options['paid'] = [
            'value' => self::PAYMENT_STATUS['paid'],
            'selected' => ( ( $order->payment_status == self::PAYMENT_STATUS['paid'] ) ? true : false ),
        ];

        $options['unpaid'] = [
            'value' => self::PAYMENT_STATUS['unpaid'],
            'selected' => ( ( $order->payment_status == self::PAYMENT_STATUS['unpaid'] ) ? true : false ),
        ];

        $options['canceled'] = [
            'value' => self::PAYMENT_STATUS['canceled'],
            'selected' => ( ( $order->payment_status == self::PAYMENT_STATUS['canceled'] ) ? true : false ),
        ];


        return $options;
    }

    private function setDeliveryStatusOptions($order)
    {
        $options = [];

        $options['waiting']     = [
            'value'     => self::DELIVERY_STATUS['waiting'],
            'selected'  => ( ( $order->delivery_status == self::DELIVERY_STATUS['waiting'] ) ? true : false ),
        ];

        $options['confirmed']     = [
            'value'     => self::DELIVERY_STATUS['confirmed'],
            'selected'  => ( ( $order->delivery_status == self::DELIVERY_STATUS['confirmed'] ) ? true : false ),
        ];

        $options['on_progress']   = [
            'value'     => self::DELIVERY_STATUS['on_progress'],
            'selected'  => ( ( $order->delivery_status == self::DELIVERY_STATUS['on_progress'] ) ? true : false ),
        ];

        $options['canceled']   = [
            'value'     => self::DELIVERY_STATUS['canceled'],
            'selected'  => ( ( $order->delivery_status == self::DELIVERY_STATUS['canceled'] ) ? true : false ),
        ];


        switch ($order->delivery_method) {
            case self::DELIVERY_METHOD['pickup']:
                $options['ready']         = [
                    'value'     => self::DELIVERY_STATUS['ready'],
                    'selected'  => ( ( $order->delivery_status == self::DELIVERY_STATUS['ready'] ) ? true : false ),
                ];

                break;

            case self::DELIVERY_METHOD['delivery']:
                $options['delivery']      = [
                    'value'     => self::DELIVERY_STATUS['delivery'],
                    'selected'  => ( ( $order->delivery_status == self::DELIVERY_STATUS['delivery'] ) ? true : false ),
                ];

                $options['finish']        = [
                    'value'     => self::DELIVERY_STATUS['finish'],
                    'selected'  => ( ( $order->delivery_status == self::DELIVERY_STATUS['finish'] ) ? true : false ),
                ];

                $options['failed']        = [
                    'value'     => self::DELIVERY_STATUS['failed'],
                    'selected'  => ( ( $order->delivery_status == self::DELIVERY_STATUS['failed'] ) ? true : false ),
                ];


                break;
        }


        return $options;
    }

    private function getTotalPriceFromSubtotalPrice($carts)
    {
        $totalPrice = 0;

        foreach ($carts as $c) {
            $totalPrice += $c->cart_subtotal_amount;
        }

        return $totalPrice;
    }
}
