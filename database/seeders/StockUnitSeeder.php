<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\StockUnit;

class StockUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $stockUnits = [
            [
                'name' => 'Mililiter',
            ],
            [
                'name' => 'Gram',
            ],
        ];

        foreach ($stockUnits as $su) {
            StockUnit::create($su);
        }
    }
}
