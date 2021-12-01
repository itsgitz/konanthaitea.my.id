<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RestockHistoriesController extends Controller
{
    //
    public function index()
    {
        $histories = DB::table('restock_histories')
            ->join('stock_units', 'restock_histories.stock_units_id', '=', 'stock_units.id')
            ->select(
                'restock_histories.name AS stock_name',
                'restock_histories.quantity AS stock_quantity',
                'restock_histories.total_price AS stock_total_price',
                'restock_histories.invoice_image AS invoice_image',
                'restock_histories.created_at AS stock_created_at',
                'stock_units.name AS unit_name',
            )
            ->get();


        return view('admin.stocks.history', [
            'histories' => $histories,
        ]);
    }
}
