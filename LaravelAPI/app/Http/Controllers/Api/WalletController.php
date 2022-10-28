<?php

namespace App\Http\Controllers\Api;

use App\Contracts\WalletRepositoryInterface;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    public function userWallet(WalletRepositoryInterface $walletRepository)
    {
        return $walletRepository->getWallet(auth()->id());

    }
}
