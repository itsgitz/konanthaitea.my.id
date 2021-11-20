<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StockUnit;


class StockUnitsController extends Controller
{
    //
    public function unit()
    {
        $stockUnits = StockUnit::all();


        return view('admin.stock_units', [
            'stockUnits' => $stockUnits,
        ]);
    }

    public function create(Request $r)
    {
        $stockUnit = new StockUnit;
        $stockUnit->name = $r->name;
        $stockUnit->save();

        return redirect()
            ->route('admin_stock_units_get');
    }
}
