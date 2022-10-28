<?php

namespace App\Contracts;


interface WalletRepositoryInterface
{
    public function getWallet($user_id);

    public function isWalletSufficient(int $user_id, int|float $minimum_amount): bool;

    public function deductFromWallet($user_id, $amount);

    public function addToWallet($user_id, $amount);

}
