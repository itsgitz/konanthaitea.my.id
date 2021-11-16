<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(Request $r)
    {
        return view('login');
    }

    public function auth(Request $r)
    {
        $credentials = $r->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            //Redirect to cart page if use redirected to login page before
            //adding items to the cart
            if ( $r->session()->has('redirect_before_cart') ) {

                //Regenerate session for user login
                $r->session()->regenerate();


                return redirect()
                    ->route('client_cart_get');
            }

            $r->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email'     => 'Alamat e-mail yang anda masukan salah atau tidak terdaftar',
            'password'  => 'Password yang anda masukan salah'
        ]);
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect()
            ->route('client_home');
    }
}
