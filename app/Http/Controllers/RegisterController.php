<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use App\Models\Client;

class RegisterController extends Controller
{
    //
    public function index(Request $r)
    { 
        return view('register', [
            'menuId' => !empty( $r->query('menu_id') ) ? $r->query('menu_id') : '',
            'redirectBeforeOrder' => !empty( $r->query('redirect_before_order') ) ? $r->query('redirect_before_order') : '',
        ]);
    }

    public function create(Request $r)
    {
        //Validating the input
        $r->validate(
            [
                'name'                  => ['required', 'min:6', 'unique:App\Models\Client,name'],
                'email'                 => ['required', 'email:rfc,dns', 'unique:App\Models\Client,email'],
                'password'              => ['required', 'min:6'],
                'password_confirmation' => ['required', 'same:password'],
            ],
            [
                'required'  => 'Mohon untuk memasukan data ke form registrasi',
                'email'     => 'Format alamat email yang anda masukan salah',
                'min'       => 'Minimal harus 6 karakter',
                'same'      => 'Konfirmasi password tidak sama',
                'unique'    => 'Data telah digunakan'
            ],
        );


        //Create a new user if validated
        $client = new Client;
        $client->name       = $r->name;
        $client->email      = $r->email;
        $client->password   = Hash::make($r->password);
        $client->save();

        Auth::login($client);

        return redirect()
            ->route('client_home')
            ->with('registered_message', 'Akunmu telah aktif dan terdaftar, silahkan pesan minumanmu!');
    }
}
