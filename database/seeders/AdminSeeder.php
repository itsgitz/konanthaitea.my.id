<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin              = new Admin;
        $admin->name        = env('ADMIN_NAME');
        $admin->email       = env('ADMIN_EMAIL');
        $admin->password    = Hash::make(env('ADMIN_PASSWORD'));
        $admin->save();
    }
}
