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
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'A',
            'email' => 'a@example.com',
            'currency' => 'USD',
            'primary_wallet' => 500,
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'B',
            'email' => 'b@example.com',
            'currency' => 'EUR',
            'primary_wallet' => 400,
            'password' => Hash::make('123456'),
        ]);
    }
}
