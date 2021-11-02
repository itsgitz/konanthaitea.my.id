<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;

class InvoicesController extends Controller
{
    //
    public function index(Request $r)
    {
        return view('admin.invoices', [
            'invoices' => Invoice::all(),
        ]);
    }
}
