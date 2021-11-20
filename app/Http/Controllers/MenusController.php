<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $menuStocks     = DB::table('menu_stocks')
            ->join('menus', 'menu_stocks.menu_id', '=', 'menus.id')
            ->join('stocks', 'menu_stocks.stock_id', '=', 'stocks.id')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->where('menus.id', '=', $id)
            ->select(
                'stocks.name AS stock_name',
                'menu_stocks.quantity AS recipe_quantity',
                'stock_units.name AS unit'
            )
            ->get();
        
        return view('admin.menus.show', [
            'menu'       => $menu,
            'menuStocks' => $menuStocks,
        ]);
    }
}
