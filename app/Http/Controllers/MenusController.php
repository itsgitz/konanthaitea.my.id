<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\MenuStock;

class MenusController extends Controller
{
    const RECIPE_EMPTY_ERROR_MESSAGE    = 'Rincian resep tidak boleh kosong (minimal masukan satu item)';
    const STOCK_EMPTY_ERROR_MESSAGE     = 'Jumlah / kuantitas item pada resep tidak boleh kosong';
    const ADD_MENU_MESSAGE              = 'Berhasil menambah menu';

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

    public function create()
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

        return view('admin.menus.create', [
            'stocks' => $stocks,
        ]);
    }

    public function store(Request $r)
    {
        $recipes    = $this->checkRecipes($r);
        $stocks     = $this->checkStocks($r);

        if (!$recipes) {
            return redirect()
                ->route('admin_menu_add_get')
                ->with('admin_error_add_menu_message', self::RECIPE_EMPTY_ERROR_MESSAGE);
        }

        if (!$stocks) {
            return redirect()
                ->route('admin_menu_add_get')
                ->with('admin_error_add_menu_message', self::STOCK_EMPTY_ERROR_MESSAGE);
        }

        $r->validate(
            [
                'name'      => ['required', 'unique:App\Models\Menu,name', 'min:3'],
                'price'     => ['required', 'numeric'],
                'quantity'  => ['required', 'min:1'],
            ],
            [
                'name.required'     => 'Nama menu tidak boleh kosong',
                'name.unique'       => 'Nama menu telah terdaftar',
                'name.min'          => 'Nama menu minimal 3 karakter',
                'price.required'    => 'Harga menu tidak boleh kosong',
                'price.numeric'     => 'Harga menu harus angka',
                'quantity.required' => 'Jumlah menu tidak boleh kosong',
                'quantity.min'      => 'Jumlah menu minimal harus 1',
            ]
        );

        //Add menu
        $menu           = new Menu;
        $menu->name     = $r->name;
        $menu->price    = $r->price;
        $menu->quantity = $r->quantity;
        $menu->status   = $r->status;
        $menu->save();

        $menuId = $menu->id;

        foreach ($r->recipes as $re) {
            if ( isset( $re['id'] ) ) {
                $menuStock = new MenuStock;
                $menuStock->menu_id     = $menuId;
                $menuStock->stock_id    = $re['id'];
                $menuStock->quantity    = $re['quantity'];
                $menuStock->save();
            }
        }

        return redirect()
            ->route('admin_menu_get')
            ->with('admin_add_menu_message', self::ADD_MENU_MESSAGE);
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
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

        return view('admin.menus.edit', [
            'menu'      => $menu,
            'stocks'    => $stocks,
        ]);
    }

    public function update(Request $r, $id)
    {

    }

    public function delete(Request $r, $id)
    {

    }

    private function checkRecipes(Request $r)
    {
        //Get total received recipes
        $totalRecipes = 0;
        foreach ($r->recipes as $r) {
            if ( isset($r['id']) ) {
                $totalRecipes += 1;
            }
        }

        if ($totalRecipes == 0) {
            return false;
        } else {
            return true;
        }
    }

    private function checkStocks(Request $r)
    {
        $emptyQuantity = 0;

        foreach ($r->recipes as $re) {
            if ( isset($re['id']) ) {
                if ( $re['quantity'] == 0 ) {
                    $emptyQuantity += 1;
                }
            }
        }

        //If there's empty quantity, return false
        //it will redirect with error message
        if ($emptyQuantity != 0) {
            return false;
        } else {
            return true;
        }
    }
}
