<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function index(Request $r)
    {
        return view('register');
    }

    public function create(Request $r)
    {
        $credentials = $r->validate([
            'email'                 => ['required', 'email'],
            'password'              => ['required', 'min:6'],
            'password_confirmation' => ['required', 'min:6', 'same:password'],
        ]);

        return back()->withErrors([
            'email'     => 'Alamat email yang anda masukan salah',
            'password'  => 'Password minimal 6 karakter',
            'password_confirmation' => 'Konfirmasi password tidak sama'
        ]);
    }
}
