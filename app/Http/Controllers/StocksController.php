<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stock;

class StocksController extends Controller
{
    //
    public function index(Request $r)
    {
        return view('admin.stocks', [
            'stocks' => Stock::all(),
        ]);
    }
}
