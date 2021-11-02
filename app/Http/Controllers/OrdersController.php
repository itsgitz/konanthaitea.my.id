<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\Client;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\MenuStock;


class OrdersController extends Controller
{
    //
    public function adminIndex(Request $r)
    {
        $orders = DB::table('orders')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('menus', 'orders.menu_id', '=', 'menus.id')
            ->select(
                'orders.id',
                'menus.name AS menu_name',
                'orders.quantity',
                'clients.name AS client_name',
                'orders.payment_status',
                'orders.order_status',
                'orders.created_at'
            )
            ->get();

        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function adminShow(Request $r, $id)
    {
        $order  = Order::find($id);
        $client = Client::find($order->client_id);
        $menu   = Menu::find($order->menu_id);

        $order->client_name = $client->name;
        $order->menu_name   = $menu->name;
        
        return view('admin.orders.show', [
            'order' => $order
        ]);
    }

    public function adminProcess(Request $r, $id)
    {
        $order = Order::find($id);

        switch($r->input('process')) {
            case 'Mark as Paid':
                $order->payment_status = 'Paid';
                $order->save();


                return redirect()
                    ->route('admin_orders_show', [ 'id' => $id ])
                    ->with('process_message', 'Payment status updated to Paid');
            break;

            case 'Mark as Finish':
                $order->order_status = 'Finish';
                $order->save();


                return redirect()
                    ->route('admin_orders_show', [ 'id' => $id ])
                    ->with('process_message', 'Order status updated to Finish');
            break;
        }
    }

    //Client list orders
    public function clientIndex(Request $r)
    {
        return view('client.orders.index', [
            'user' => Auth::user(),
        ]);
    }

    //Client per order details
    public function clientShow($id)
    {

    }

    //Client order process
    public function clientProcess(Request $r, $menuId)
    {
        $clientId       = Auth::user()->id;
        $menuPrice      = $r->input('menu_price');
        $orderQuantity  = $r->input('order_quantity');
        $orderType      = $r->input('order_type');
        $totalAmount    = ( $menuPrice * $orderQuantity );

        //Process order
        $order = new Order;
        $order->client_id       = $clientId;
        $order->menu_id         = $menuId;
        $order->quantity        = $orderQuantity;
        $order->total_amount    = $totalAmount;
        $order->order_type      = $orderType;
        $order->order_status    = 'On Progress';
        $order->payment_status  = 'Unpaid';
        $order->save();

        //Menu Stocks process, reduce quantity
        $menuStocks     = MenuStock::where('menu_id', $menuId)->get();
         
        //Reduce quantity = Order quantity * Applied quantity
        //Current quantity = Reduce quantity - Current quantity
        foreach ($menuStocks as $ms) {
            $stock = Stock::find($ms->stock_id);

            $reduceQuantity = ( $orderQuantity * $ms->quantity );
            $currentQuantity = ( $stock->quantity - $reduceQuantity );

            $stock->quantity = $currentQuantity;
            $stock->save();
        }

        return redirect()
            ->route('client_home')
            ->with('order_message', 'Your order is being process');
    }
}
