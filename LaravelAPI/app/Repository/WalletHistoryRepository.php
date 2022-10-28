<?php

namespace App\Repository;

use App\Contracts\ExchangeRateHistoryRepositoryInterface;
use App\Contracts\WalletHistoryRepositoryInterface;
use App\Contracts\WalletRepositoryInterface;
use App\Models\ExchangeRateHistory;
use App\Models\UserWallet;

class WalletHistoryRepository implements WalletHistoryRepositoryInterface
{

    public function create()
    {
    }

    public function listByUser()
    {
    }

    public function detail($id)
    {
    }

    public function list()
    {
        // TODO: Implement list() method.
    }
}
