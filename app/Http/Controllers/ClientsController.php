<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller
{
    const UPDATE_CLIENT_MESSAGE = 'Berhasil mengubah informasi client';
    const DELETE_CLIENT_MESSAGE = 'Berhasil menghapus client';

    //
    public function index()
    {
        $clients = Client::all();

        return view('admin.accounts.clients.index', [
            'clients' => $clients
        ]);
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('admin.accounts.clients.edit', [
            'client' => $client,
        ]);
    }

    public function update(Request $r, $id)
    {
        $r->validate(
            [
                'name'      => ['required', 'min:6'],
                'email'     => ['required', 'email:rfc,dns'],
            ],
            [
                'name.required'     => 'Nama tidak boleh kosong',
                'email.required'    => 'Email tidak boleh kosong',
                'email.email'       => 'Format alamat email yang anda masukan salah',
                'name.min'          => 'Minimal nama harus 6 karakter',
            ]
        );

        $client = Client::find($id);
        $client->name = $r->name;
        $client->email = $r->email;

        if ( isset($r->password) ) {
            $r->validate(
                [
                    'password' => ['min:6']
                ],
                [
                    'password.min' => 'Password minimal harus 6 karakter'
                ]
            );
            $client->password = Hash::make($r->password);
        }

        $client->save();

        return redirect()
            ->route('admin_clients_edit_get', [ 'id' => $id ])
            ->with('admin_update_client_message', self::UPDATE_CLIENT_MESSAGE);
    }

    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();


        return redirect()
            ->route('admin_clients_get')
            ->with('admin_delete_client_message', self::DELETE_CLIENT_MESSAGE);
    }

    public function setting(Request $r)
    {
        $client = Client::find(Auth::id());

        return view('client.setting', [
            'client' => $client
        ]);
    }

    public function updateSetting(Request $r, $id)
    {
        $client = Client::find($id);
        $client->phone_number   = $r->phone_number;
        $client->address        = $r->address;
        $client->save();

        return redirect()
            ->route('client_setting')
            ->with('client_setting_message', 'Berhasil mengubah pengaturan alamat');
    }
}
