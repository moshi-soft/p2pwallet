<?php

namespace Database\Seeders;

use App\Models\UserWallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserWallet::create([
            'user_id' => 1,
            'amount' => 500,
            'currency' => 'USD',
            'action_type' => 'PRIMARY',
        ]);
        UserWallet::create([
            'user_id' => 2,
            'amount' => 500,
            'currency' => 'EUR',
            'action_type' => 'PRIMARY',
        ]);
    }
}
