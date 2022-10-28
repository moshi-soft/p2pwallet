<?php

namespace App\Repository;

use App\AppConfig;
use App\Contracts\WalletRepositoryInterface;
use App\Models\UserWallet;

class WalletRepository implements WalletRepositoryInterface
{

    public function getWallet($user_id)
    {
        return UserWallet::where('user_id', '=', $user_id)->first();
    }

    public function isWalletSufficient(int $user_id, int|float $minimum_amount): bool
    {
        $wallet = UserWallet::select('amount')->where('user_id', '=', $user_id)->first();
        return $wallet?->amount >= $minimum_amount;
    }

    public function deductFromWallet($user_id, $amount)
    {
        $wallet = UserWallet::where('user_id', '=', $user_id)->first();
        //dd($wallet);
        $updatedAmount = $wallet->amount - $amount;
        return $wallet->update([
            'amount' => $updatedAmount,
            'action_type' => AppConfig::WALLET_ACTION_TYPE_DEDUCT
        ]);
    }

    public function addToWallet($user_id, $amount)
    {
        $wallet = UserWallet::where('user_id', '=', $user_id)->first();
        $updatedAmount = $wallet->amount + $amount;
        return $wallet->update([
            'amount' => $updatedAmount,
            'action_type' => AppConfig::WALLET_ACTION_TYPE_ADD
        ]);
    }
}
