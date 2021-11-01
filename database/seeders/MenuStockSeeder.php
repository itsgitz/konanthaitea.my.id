<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\MenuStock;

class MenuStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuStocks = [
            [
                'menu_id'   => 1,
                'stock_id'  => 1,
                'quantity'  => 1,
            ],
            [
                'menu_id'   => 1,
                'stock_id'  => 2,
                'quantity'  => 1,
            ],
        ];

        foreach ($menuStocks as $ms) {
            MenuStock::create($ms);
        }
    }
}
