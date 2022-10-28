<?php

namespace App\Repository;

use App\AppConfig;
use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
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


    public function payableUserListWithoutSelf(): array
    {
       return User::all()->except(auth()->id())?->toArray();
    }
    public function getUser()
    {
        // TODO: Implement getUser() method.
    }
}
