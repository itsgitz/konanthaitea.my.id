<?php

namespace App\Http\Controllers;

use App\Models\MenuStock;
use Illuminate\Http\Request;

class MenuStocksController extends Controller
{
    const ADD_MENU_STOCK_MESSAGE        = 'Berhasil menambah item pada resep';
    const EDIT_MENU_STOCK_ERROR_MESSAGE = 'Jumlah item pada resep tidak boleh kosong atau 0';
    const EDIT_MENU_STOCK_MESSAGE       = 'Berhasil mengubah jumlah item pada resep';
    const DELETE_MENU_STOCK_MESSAGE     = 'Berhasil menghapus item pada resep';

    //
    public function store(Request $r, $id)
    {
        $r->validate(
            [
                'name'      => ['required'],
                'quantity'  => ['required', 'min:1']
            ],
            [
                'name.required'         => 'Pilihlah salah satu item',
                'quantity.required'     => 'Jumlah tidak boleh 0 atau kosong',
                'quantity.min'          => 'Jumlah tidak boleh 0 atau kosong',
            ]
        );

        $menuStocks = new MenuStock;
        $menuStocks->menu_id    = $id;
        $menuStocks->stock_id   = $r->name;
        $menuStocks->quantity   = $r->quantity;
        $menuStocks->save();


        return redirect()
            ->route('admin_menu_show_get', [ 'id' => $id ])
            ->with('admin_add_menu_stock_message', self::ADD_MENU_STOCK_MESSAGE);
    }

    public function update(Request $r, $id)
    {
        $menuStocks = MenuStock::find($id);
        $menuStocks->quantity = $r->update_quantity;
        $menuStocks->save();


        return redirect()
            ->route('admin_menu_show_get', [ 'id' => $r->menu_id ])
            ->with('admin_edit_menu_stock_message', self::EDIT_MENU_STOCK_MESSAGE);
    }

    public function delete(Request $r, $id)
    {
        $menuStocks = MenuStock::find($id);
        $menuStocks->delete();

        return redirect()
            ->route('admin_menu_show_get', ['id' => $r->menu_id])
            ->with('admin_delete_menu_stock_message', self::DELETE_MENU_STOCK_MESSAGE);
    }
}
