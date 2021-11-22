<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;

class HomeController extends Controller
{
    //
    public function index(Request $r)
    {
        return view('client.home', [
            'menu' => Menu::all(),
        ]);
    }

    public function about(Request $r)
    {
        return view('client.about');
    }
}
