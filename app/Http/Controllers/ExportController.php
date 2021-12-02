<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\Exports\RestockHistoriesExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    //
    public function orders()
    {
        $nameFile = 'orders-' . date('d-m-Y') . '.xlsx';

        return Excel::download(new OrdersExport, $nameFile);
    }

    public function restockHistories()
    {
        $nameFile = 'restock-' . date('d-m-Y') . '.xlsx';

        return Excel::download(new RestockHistoriesExport, $nameFile);
    }
}
