<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestockHistoriesExport implements FromView, ShouldAutoSize, WithStyles
{
    public function styles(Worksheet $sheet)
    {
        return [
            'A:J' => [
                'alignment' => [
                    'vertical'  => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horzontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ],
                'wrapText' => true
            ]
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        //
        //
        $histories = DB::table('restock_histories')
            ->join('stock_units', 'restock_histories.stock_units_id', '=', 'stock_units.id')
            ->select(
                'restock_histories.name AS stock_name',
                'restock_histories.quantity AS stock_quantity',
                'restock_histories.total_price AS stock_total_price',
                'restock_histories.invoice_image AS invoice_image',
                'restock_histories.created_at AS stock_created_at',
                'stock_units.name AS unit_name',
            )
            ->get();

        return view('admin.exports.restock_histories', [
            'histories' => $histories,
        ]);
    }
}
