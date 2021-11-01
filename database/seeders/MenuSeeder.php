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
        //
        $menu           = new Menu;
        $menu->name     = 'Thai Tea';
        $menu->price    = 5000;
        $menu->status   = 'Available';
        $menu->quantity = 10;
        $menu->save();
    }
}
