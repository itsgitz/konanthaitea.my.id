<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $r)
    {
        return view('home', [
            'menu' => Menu::all(),
        ]);
    }

    public function about(Request $r)
    {
        return view('about');
    }
}
