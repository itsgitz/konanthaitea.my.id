<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\Cart;

class CartController extends Controller
{
    const ON_CART_STATUS    = 'On Cart';
    const FINISH_STATUS     = 'Finish';

    //
    public function index(Request $r)
    {
        $this->saveCart($r);

        $carts = DB::table('carts')
            ->join('clients', 'carts.client_id', '=', 'clients.id')
            ->join('menus', 'carts.menu_id', '=', 'menus.id')
            ->where('clients.id', '=', Auth::id())
            ->where('carts.status', '=', self::ON_CART_STATUS)
            ->select(
                'carts.id',
                'menus.name AS menu_name',
                'carts.quantity AS cart_quantity',
                'menus.price AS menu_price'
            )
            ->get();


        return view('client.cart', [
            'carts' => $carts,
        ]);
    }

    public function store(Request $r)
    {
        if (!Auth::check()) {
            $r->session()->put('menu_id', $r->menu_id);
            $r->session()->put('redirect_before_cart', true);

            return redirect()
                ->route('client_login_get');
        }

        $this->saveCart($r);
 
        return redirect()
            ->route('client_cart_get');
    }

    public function checkout()
    {
    }

    private function saveCart(Request $r)
    {
        if (Auth::check()) {
            if ( $r->session()->has('menu_id') ) {
                $cart = new Cart;
                $cart->client_id    = Auth::id();
                $cart->menu_id      = $r->session()->get('menu_id');
                $cart->status       = self::ON_CART_STATUS;
                $cart->quantity     = 1;
                $cart->save();

                $this->destroyCartSession($r);
            } 
        } else {
            $this->destroyCartSession($r);
        }
    }

    private function destroyCartSession(Request $r)
    {
        //Destroy the redirect session
        $r->session()->forget('menu_id');
        $r->session()->forget('redirect_before_cart');
        $r->session()->forget('redirect_to');

    }
}
