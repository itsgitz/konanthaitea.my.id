<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StockUnit;


class StockUnitsController extends Controller
{
    const ADD_STOCK_UNIT_MESSAGE = 'Berhasil menambahkan unit';

    //
    public function index()
    {
        $stockUnits = StockUnit::all();


        return view('admin.stocks.units.index', [
            'stockUnits' => $stockUnits,
        ]);
    }

    public function create(Request $r)
    {
        $stockUnit = new StockUnit;
        $stockUnit->name = $r->name;
        $stockUnit->save();

        return redirect()
            ->route('admin_stock_units_get')
            ->with('add_stock_unit_message', self::ADD_STOCK_UNIT_MESSAGE);
    }
}
