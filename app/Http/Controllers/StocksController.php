<?php

namespace App\Http\Controllers;

use App\Models\RestockHistory;
use App\Models\Stock;
use App\Models\StockUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StocksController extends Controller
{
    const ADD_STOCK_MESSAGE = 'Berhasil menambah stock baru';

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
        $stockUnits = StockUnit::all();

        return view('admin.stocks.create', [
            'units' => $stockUnits,
        ]);
    }

    public function store(Request $r)
    {
        $r->validate(
            [
                'name'          => ['required', 'min:3', 'unique:App\Models\Stock,name'],
                'quantity'      => ['required', 'min:1', 'numeric'],
                'unit'          => ['required'],
                'total_price'   => ['required', 'min:1', 'numeric']
            ],
            [
                'name.required'         => 'Mohon untuk mengisi nama stock',
                'name.min'              => 'Minimal nama 3 karakter',
                'name.unique'           => 'Nama stock telah terdaftar',
                'quantity.required'     => 'Mohon untuk mengisi jumlah stock',
                'quantity.min'          => 'Minimal jumlah stock adalah 1 atau tidak boleh kosong',
                'unit.required'         => 'Mohon untuk mengisi unit stock',
                'total_price.required'  => 'Mohon untuk mengisi total belanja stock',
                'total_price.min'       => 'Total belanja tidak boleh nol atau kosong',
            ]
        );

        //Add data to `stocks` table
        $stock                  = new Stock;
        $stock->stock_units_id  = $r->unit;
        $stock->name            = $r->name;
        $stock->quantity        = $r->quantity;
        $stock->status          = 'Available';
        $stock->save();

        $stockId = $stock->id;

        //Add data to `restock_histories` for restock history
        $restock                    = new RestockHistory();
        $restock->stock_id          = $stockId;
        $restock->stock_units_id    = $r->unit;
        $restock->name              = $r->name;
        $restock->quantity          = $r->quantity;
        $restock->status            = 'Available';
        $restock->total_price       = $r->total_price;
        $restock->save();

        return redirect()
            ->route('admin_stocks_get')
            ->with('admin_add_stock_message', self::ADD_STOCK_MESSAGE);
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
