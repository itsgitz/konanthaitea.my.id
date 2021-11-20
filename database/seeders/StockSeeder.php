<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stocks = [
            [
                'stock_units_id'    => 1, //Mililiter
                'name'              => 'Air',
                'quantity'          => 100,
                'status'            => 'Available',
            ],
            [
                'stock_units_id'    => 2, //Gram
                'name'              => 'Gula',
                'quantity'          => 100,
                'status'            => 'Available',
            ]

        ];

        foreach ($stocks as $s) {
            Stock::create($s);
        }
    }
}
