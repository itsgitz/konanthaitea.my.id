<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\RestockHistory;

class RestockHistoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $stocks = [
            [
                'stock_id'          => 1,
                'stock_units_id'    => 1, //Mililiter
                'name'              => 'Air',
                'quantity'          => 100,
                'status'            => 'Available',
                'total_price'       => 500000,
            ],
            [
                'stock_id'          => 2,
                'stock_units_id'    => 2, //Gram
                'name'              => 'Gula',
                'quantity'          => 100,
                'status'            => 'Available',
                'total_price'       => 500000,
            ]
        ];

        foreach ($stocks as $s) {
            RestockHistory::create($s);
        }
    }
}
