<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['username' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('admin'), 'is_blocked' => '0', 'id_role' => '1'],
        ]);
    }
}
