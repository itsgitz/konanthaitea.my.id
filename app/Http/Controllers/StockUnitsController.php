<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

use App\Models\StockUnit;


class StockUnitsController extends Controller
{
    const ADD_STOCK_UNIT_MESSAGE = 'Berhasil menambahkan unit';
    const UPDATE_STOCK_UNIT_MESSAGE = 'Berhasil update unit';
    const DELETE_ERROR_STOCK_UNIT_MESSAGE = 'Tidak bisa menghapus stock karena saat ini sedang terpakai oleh stock';
    const DELETE_STOCK_UNIT_MESSAGE = 'Berhasil menghapus stock unit';

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

    public function update(Request $r, $id)
    {
        $r->validate(
            [
                'edit_stock_unit_name' => ['required', 'min:3', 'unique:App\Models\StockUnit,name']
            ],
            [
                'edit_stock_unit_name.required' => 'Data tidak boleh kosong!',
                'edit_stock_unit_name.min'      => 'Minimal nama harus 3 karakter',
                'edit_stock_unit_name.unique'   => 'Nama telah terdaftar',
            ]
        );

        $stockUnit          = StockUnit::find($id);
        $stockUnit->name    = $r->edit_stock_unit_name;
        $stockUnit->save();

        return redirect()
            ->route('admin_stock_units_get')
            ->with('admin_edit_stock_unit_message', self::UPDATE_STOCK_UNIT_MESSAGE);
    }

    public function delete(Request $r, $id)
    {
        $stocks = Stock::where('stock_units_id', $id)->get();

        if ( $stocks->isNotEmpty() ) {
            return redirect()
                ->route('admin_stock_units_get')
                ->with('admin_delete_error_stock_unit_message', self::DELETE_ERROR_STOCK_UNIT_MESSAGE);
        }

        $stockUnits = StockUnit::find($id);
        $stockUnits->delete();

        return redirect()
            ->route('admin_stock_units_get')
            ->with('admin_delete_stock_unit_message', self::DELETE_STOCK_UNIT_MESSAGE);
    }
}
