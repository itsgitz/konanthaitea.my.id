<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    const ADD_ADMIN_MESSAGE     = 'Berhasil menambahkan user admin';
    const UPDATE_ADMIN_MESSAGE  = 'Berhasil mengubah informasi user admin'; 
    const DELETE_ADMIN_MESSAGE  = 'Berhasil menghapus user admin';

    //
    public function index()
    {
        return view('admin.index');
    }

    public function account()
    {
        $admins = Admin::all();

        return view('admin.accounts.admins.index', [
            'admins' => $admins,
        ]);
    }

    public function create()
    {
        return view('admin.accounts.admins.create');
    }

    public function store(Request $r)
    {
        $r->validate(
            [
                'name'      => ['required', 'min:6', 'unique:App\Models\Admin,name'],
                'email'     => ['required', 'email:rfc,dns', 'unique:App\Models\Admin,email'],
                'password'  => ['required', 'min:6'],
            ],
            [
                'name.required'     => 'Nama tidak boleh kosong',
                'name.min'          => 'Minimal nama harus 6 karakter',
                'name.unique'       => 'Nama telah terdaftar',
                'email.required'    => 'Email tidak boleh kosong',
                'email.unique'      => 'Email telah terdaftar',
                'email.email'       => 'Format alamat email yang anda masukan salah',
            ]
        );

        $admin = new Admin;
        $admin->name        = $r->name;
        $admin->email       = $r->email;
        $admin->password    = Hash::make($r->password);
        $admin->save();

        return redirect()
            ->route('admin_accounts_get')
            ->with('admin_add_admin_message', self::ADD_ADMIN_MESSAGE);
    }

    public function edit($id)
    {
        $admin = Admin::find($id);

        return view('admin.accounts.admins.edit', [
            'admin' => $admin,
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

        $admin = Admin::find($id);
        $admin->name = $r->name;
        $admin->email = $r->email;

        if ( isset($r->password) ) {
            $r->validate(
                [
                    'password' => ['min:6']
                ],
                [
                    'password.min' => 'Password minimal harus 6 karakter'
                ]
            );
            $admin->password = Hash::make($r->password);
        }

        $admin->save();

        return redirect()
            ->route('admin_accounts_edit_get', [ 'id' => $id ])
            ->with('admin_update_admin_message', self::UPDATE_ADMIN_MESSAGE);
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        $admin->delete();


        return redirect()
            ->route('admin_accounts_get')
            ->with('admin_delete_admin_message', self::DELETE_ADMIN_MESSAGE);
    }
}
