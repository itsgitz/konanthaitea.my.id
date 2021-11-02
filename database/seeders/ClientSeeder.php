<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $client             = new Client;
        $client->name       = env('CLIENT_NAME');
        $client->email      = env('CLIENT_EMAIL');
        $client->password   = Hash::make(env('CLIENT_PASSWORD'));
        $client->save();
    }
}
