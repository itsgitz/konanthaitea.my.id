<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name'      => 'Thai Tea',
                'price'     => 5000,
                'status'    => 'Available',
                'quantity'  => 10,
            ],
            [
                'name'      => 'Kopi Sobek',
                'price'     => 100000,
                'status'    => 'Available',
                'quantity'  => 50,
            ],
        ];

        foreach ($menus as $m) {
            Menu::create($m);
        }
    }
}
