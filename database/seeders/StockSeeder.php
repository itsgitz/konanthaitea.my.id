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
                'name'      => 'Air',
                'quantity'  => 10,
                'unit'      => 'Liter',
            ],
            [
                'name'      => 'Gula',
                'quantity'  => 10,
                'unit'      => 'Kilogram',
            ]

        ];

        foreach ($stocks as $s) {
            Stock::create($s);
        }
    }
}
