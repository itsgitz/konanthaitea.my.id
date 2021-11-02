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
                'quantity'  => 100,
                'unit'      => 'Liter',
                'status'    => 'Available',
            ],
            [
                'name'      => 'Gula',
                'quantity'  => 100,
                'unit'      => 'Kilogram',
                'status'    => 'Available',
            ]

        ];

        foreach ($stocks as $s) {
            Stock::create($s);
        }
    }
}
