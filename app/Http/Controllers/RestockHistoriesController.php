<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use PDF;

class RestockHistoriesController extends Controller
{
    //
    public function index()
    {
        $histories = $this->generateData();

        return view('admin.stocks.history', [
            'histories' => $histories,
        ]);
    }

    public function export()
    {
        // route admin_export_pdf_restock_histories_get
        $histories = $this->generateData();

        $pdf = PDF::loadView('admin.exports.restock_histories_pdf', [
            'histories' => $histories
        ]);

        $fileName = 'restock-history_' . date('d-m-Y') . '.pdf';

        return $pdf->download($fileName);
    }

    private function generateData()
    {
        $historiesPerRequest = DB::table('request_stocks')
            //->whereNotNull('request_stocks.request_id')
            ->where('status', '=', 'Finish')
            ->groupBy('request_id')
            ->get();


        $histories = [];

        foreach ($historiesPerRequest as $h) {
            $restock = DB::table('restock_histories')
                ->join('stocks', 'restock_histories.stock_id', '=', 'stocks.id')
                ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
                ->join('request_stocks', 'restock_histories.request_id', '=', 'request_stocks.request_id')
                ->select(
                    'restock_histories.request_id AS request_id',
                    'restock_histories.name AS stock_name',
                    'restock_histories.quantity AS stock_quantity',
                    'stock_units.name AS unit_name',
                    'restock_histories.invoice_image AS invoice_image',
                    'restock_histories.total_price AS total_price',
                    'restock_histories.created_at AS created_at',
                    'request_stocks.description AS description'
                )
                //->whereNotNull('restock_histories.request_id')
                ->where('restock_histories.request_id', '=', $h->request_id)
                ->groupBy('stocks.id')
                ->get()
                ->toArray();

            $totalPay = 0;

            foreach ($restock as $r) {
                $totalPay += $r->total_price;
            }

            array_push($histories, [
                'request_id'    => $h->request_id,
                'items'         => $restock,
                'total_pay'     => $totalPay,
                'invoice_image' => $restock[0]->invoice_image ?? '',
                'created_at'    => $restock[0]->created_at ?? ''
            ]);
        }

        return $histories;
    }
}
