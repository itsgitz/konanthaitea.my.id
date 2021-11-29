<?php

namespace App\Http\Controllers;

use App\Models\MenuStock;
use Illuminate\Http\Request;

class MenuStocksController extends Controller
{
    const ADD_MENU_STOCK_MESSAGE = 'Berhasil menambah item pada resep';

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
}
