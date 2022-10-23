<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface WalletInterface
{
    public function checkWallet(Request $request);

    public function deductFromWallet(Request $request);

    public function addToBalance(Request $request);

}
