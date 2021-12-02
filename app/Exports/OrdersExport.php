<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        //
        //
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
            ->distinct()
            ->orderBy('orders.created_at', 'DESC')
            ->get();

        return view('admin.exports.orders', [
            'orders' => $orders
        ]);
    }
}
