<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RefSatkerSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::create([
            'nama' => 'Admin',
            'nip' => '123456789012345678',
            'password' => Hash::make('123'),
            'kode_satker' => '411792',
            'role' => 'administrator',
        ]);

        \App\Models\RefMenu::create([
            'role_name' => 'manager',
            'route_name' => 'ref-menu.index',
            'url_name' => 'ref-menu',
            'menu_name' => 'Referensi Menu',
            'no_urut' => '98',
        ]);
        \App\Models\RefMenu::create([
            'role_name' => 'manager',
            'route_name' => 'user.index',
            'url_name' => 'user',
            'menu_name' => 'Referensi User',
            'no_urut' => '99',
        ]);

        $this->call(RefSatkerSeeder::class);
    }
}
