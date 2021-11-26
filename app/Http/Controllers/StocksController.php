<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StocksController extends Controller
{
    //
    public function index(Request $r)
    {
        $stocks = DB::table('stocks')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->select(
                'stocks.id AS stock_id',
                'stocks.name AS stock_name',
                'stocks.quantity AS stock_quantity',
                'stocks.status AS stock_status',
                'stock_units.name AS unit_name',
                'stocks.created_at AS stock_created_at'
            )
            ->get();


        return view('admin.stocks.index', [
            'stocks' => $stocks,
        ]);
    }

    public function show($id)
    {

    }

    public function create()
    {

    }

    public function store(Request $r, $id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $r, $id)
    {

    }

    public function delete($id)
    {

    }
}
