<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;
use App\Models\MenuStock;
use App\Models\Stock;

class MenusController extends Controller
{
    //
    public function index(Request $r)
    {
        return view('admin.menus.index', [
            'menus' => Menu::all(),
        ]);
    }

    public function show($id)
    { 
        $menu           = Menu::find($id);
        $menuStocks     = MenuStock::where('menu_id', $id)->get();

        foreach ($menuStocks as $k => $ms) {
            $stock = Stock::find($ms->stock_id);

            $menuStocks[$k]->name = $stock->name;
            $menuStocks[$k]->unit = $stock->unit;
        }

        return view('admin.menus.show', [
            'menu'       => $menu,
            'menuStocks' => $menuStocks,
        ]);
    }
}
