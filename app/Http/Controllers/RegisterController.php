<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use App\Models\Client;

class RegisterController extends Controller
{
    const REGISTERED_MESSAGE    = 'Akunmu telah aktif dan terdaftar, silahkan pesan minumanmu!';

    //
    public function index(Request $r)
    {
        return view('client.auth.register');
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
                'required'      => 'Mohon untuk memasukan data ke form registrasi',
                'email'         => 'Format alamat email yang anda masukan salah',
                'name.min'      => 'Minimal nama harus 6 karakter',
                'password.min'  => 'Minimal password harus 6 karakter',
                'same'          => 'Konfirmasi password tidak sama',
                'name.unique'   => 'Nama yang anda masukan telah terdaftar',
                'email.unique'  => 'Alamat email yang anda masukan telah terdaftar'
            ],
        );


        //Create a new user if validated
        $client = new Client;
        $client->name       = $r->name;
        $client->email      = $r->email;
        $client->password   = Hash::make($r->password);
        $client->phone_number   = $r->phone_number;
        $client->address        = $r->address;
        $client->save();

        Auth::login($client);

        if ( $r->session()->has('redirect_before_cart') ) {
            return redirect()
                ->route('client_cart_get')
                ->with('registered_message', self::REGISTERED_MESSAGE);
        }

        return redirect()
            ->route('client_home')
            ->with('registered_message', self::REGISTERED_MESSAGE);
    }
}
