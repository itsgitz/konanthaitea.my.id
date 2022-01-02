<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    const ON_CART_STATUS        = 'On Cart';
    const CART_ADD_MESSAGE      = 'Berhasil menambahkan item ke dalam keranjang';
    const CART_DELETE_MESSAGE   = 'Berhasil menghapus item dari keranjang';
    const CART_UPDATE_MESSAGE   = 'Berhasil mengubah item di keranjang';

    //
    public function index(Request $r)
    {
        $this->saveCart($r);

        $carts          = $this->getOnCart();
        $totalAmount    = $this->getTotalAmount($carts);

        return view('client.carts.index', [
            'carts'         => $carts,
            'totalAmount'   => $totalAmount,
        ]);
    }

    public function store(Request $r)
    {
        if (!Auth::check()) {
            $r->session()->put('menu_id', $r->menu_id);
            $r->session()->put('menu_price', $r->menu_price);
            $r->session()->put('redirect_before_cart', true);

            return redirect()
                ->route('client_login_get');
        }

        $this->saveCart($r);

        return redirect()
            ->route('client_cart_get')
            ->with('cart_add_message', self::CART_ADD_MESSAGE);
    }

    public function delete($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->delete();

        return redirect()
            ->route('client_cart_get')
            ->with('cart_delete_message', self::CART_DELETE_MESSAGE);
    }

    public function edit($cartId)
    {
        $cart = DB::table('carts')
            ->join('clients', 'carts.client_id', '=', 'clients.id')
            ->join('menus', 'carts.menu_id', '=', 'menus.id')
            ->where('carts.id', '=', $cartId)
            ->select(
                'carts.id',
                'menus.name AS menu_name',
                'menus.quantity AS menu_quantity',
                'carts.quantity AS cart_quantity',
                'menus.price AS menu_price',
            )
            ->first();

        if (!isset( $cart )) {
            abort(404);
        }

        return view('client.carts.edit', [
            'cart' => $cart
        ]);
    }

    public function update(Request $r, $cartId)
    {
        $r->validate(
            [
                'cart_quantity'  => ['required', 'numeric', 'not_in:0', "max:{$r->menu_quantity}"],
            ],
            [
                'cart_quantity.not_in'  => 'Jumlah minuman tidak boleh kosong atau nol',
                'cart_quantity.max'     => "Maaf, saat ini hanya tersedia {$r->menu_quantity} unit {$r->menu_name}"
            ],
        );

        $cart                   = Cart::find($cartId);
        $cart->quantity         = $r->cart_quantity;
        $cart->subtotal_amount  = ( $r->menu_price * $r->cart_quantity );
        $cart->save();


        return redirect()
            ->route('client_cart_get')
            ->with('cart_update_message', self::CART_UPDATE_MESSAGE);
    }

    public function getOnCartCount()
    {
        $carts = $this->getOnCart();


        return $carts->count();
    }


    private function getOnCart()
    {
        $carts = DB::table('carts')
            ->join('clients', 'carts.client_id', '=', 'clients.id')
            ->join('menus', 'carts.menu_id', '=', 'menus.id')
            ->where('clients.id', '=', Auth::id())
            ->where('carts.status', '=', self::ON_CART_STATUS)
            ->select(
                'carts.id AS cart_id',
                'menus.id AS menu_id',
                'menus.name AS menu_name',
                'menus.quantity AS menu_quantity',
                'carts.quantity AS cart_quantity',
                'menus.price AS menu_price',
                'carts.subtotal_amount AS cart_subtotal_amount'
            )
            ->get();


        return $carts;
    }

    private function getTotalAmount($carts)
    {
        $totalAmount = 0;

        foreach ($carts as $c) {
            $totalAmount += $c->cart_subtotal_amount;
        }


        return $totalAmount;
    }

    private function saveCart(Request $r)
    {
        $menuId = '';
        $menuPrice = 0;

        //Save operation only allowed for logged in user
        if (Auth::check()) {

            //If user redirected to login from add cart item (home page)
            //or directly add an item from home page
            //Run the save operation
            if ( $r->session()->has('redirect_before_cart') || isset( $r->menu_id ) ) {

                //Get the menu_id, redirected from login page, get from session
                if ( $r->session()->has('menu_id') ) {
                    $menuId     = $r->session()->get('menu_id');
                    $menuPrice  = $r->session()->get('menu_price');

                } else {
                    //Else, get menu_id from post input (home page)
                    $menuId     = $r->menu_id;
                    $menuPrice  = $r->menu_price;
                }

                //If item is exist on cart, only update the quantity
                if ( $this->isOnCartExist($menuId) ) {

                    //Get current data for get the current quantity
                    $currentData = Cart::where([
                        'client_id' => Auth::id(),
                        'menu_id'   => $menuId,
                        'status'    => self::ON_CART_STATUS
                    ])->first();

                    //Get menu price
                    $menu = Menu::find($menuId);

                    $quantity       = $currentData->quantity + 1;
                    $subtotalAmount = $menu->price * $quantity;

                    //Update quantity (+1)
                    Cart::where('client_id', Auth::id())
                        ->where('menu_id', $menuId)
                        ->where('status', self::ON_CART_STATUS)
                        ->update([
                            'quantity'          => $quantity,
                            'subtotal_amount'   => $subtotalAmount
                        ]);

                } else {
                    //If item is not exist on cart, create new item on cart
                    $cart = new Cart;
                    $cart->client_id        = Auth::id();
                    $cart->menu_id          = $menuId;
                    $cart->status           = self::ON_CART_STATUS;
                    $cart->quantity         = 1;
                    $cart->subtotal_amount  = $menuPrice;
                    $cart->save();
                }

                $this->destroyCartSession($r);

                return redirect()
                    ->route('client_cart_get')
                    ->with('cart_add_message', self::CART_ADD_MESSAGE);

            }  else {
                //Don't run the save operation if not redirected from add cart item
                $this->destroyCartSession($r);
            }
        } else {
            //Don't run the save operation if user is not logged in
            $this->destroyCartSession($r);
        }
    }

    private function isOnCartExist($menuId)
    {
        $carts = Cart::where([
            'client_id' => Auth::id(),
            'menu_id'   => $menuId,
            'status'    => self::ON_CART_STATUS
        ])->first();

        if ( !isset( $carts ) ) {
            return false;
        } else {
            return true;
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
