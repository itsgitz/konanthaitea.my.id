<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
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

    public function create()
    {

    }

    public function store()
    {

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
        $client = Client::find($id);
        $client->name = $r->name;
        $client->email = $r->email;

        if ( isset($r->password) ) {
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
}
