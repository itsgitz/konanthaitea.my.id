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
                'menu_id'   => 1,   //Thai Tea
                'stock_id'  => 1,   //Air
                'quantity'  => 1,   //1 Liter
            ],
            [
                'menu_id'   => 1,   //Thai Tea
                'stock_id'  => 2,   //Gula
                'quantity'  => 1,   //1 Kilogram
            ],
            [
                'menu_id'   => 2,   //Kopi Sobek
                'stock_id'  => 1,   //Air
                'quantity'  => 3,   //3 Liter
            ],
            [
                'menu_id'   => 2,   //Kopi Sobek
                'stock_id'  => 2,   //Gula
                'quantity'  => 5,   //5 Kilogram
            ]
        ];

        foreach ($menuStocks as $ms) {
            MenuStock::create($ms);
        }
    }
}
