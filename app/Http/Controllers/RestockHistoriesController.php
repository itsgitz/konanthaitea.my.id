<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestockHistoriesController extends Controller
{
    //
    public function index()
    {
        return view('admin.stocks.history');
    }
}
