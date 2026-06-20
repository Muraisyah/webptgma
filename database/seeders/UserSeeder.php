<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user')->insertOrIgnore([
            [
                'nama_lengkap' => 'Administrator',
                'email' => 'admin@example.com',
                'no_hp' => '081234567890',
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Pimpinan',
                'email' => 'pimpinan@example.com',
                'no_hp' => '081298765432',
                'username' => 'pimpinan',
                'password' => Hash::make('password123'),
                'role' => 'Pimpinan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
