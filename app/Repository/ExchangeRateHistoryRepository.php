<?php

namespace App\Repository;

use App\Contracts\ExchangeRateHistoryRepositoryInterface;
use App\Contracts\WalletRepositoryInterface;
use App\Models\ExchangeRateHistory;
use App\Models\UserWallet;

class ExchangeRateHistoryRepository implements ExchangeRateHistoryRepositoryInterface
{

    public function create($request_date, $rate, $amount, $converted_amount, $currency_from, $currency_to,
                           $rate_datetime, $isSuccess, $json)
    {
        return ExchangeRateHistory::create([
            'requested_date' => $request_date, 'rate' => $rate, 'amount' => $amount, 'converted_amount' => $converted_amount,
            'currency_from' => $currency_from, 'currency_to' => $currency_to, 'rate_datetime' => $rate_datetime,
            'success' => $isSuccess, 'exchangeRateJson' => $json
        ]);
    }

    public function listByUser()
    {
        ExchangeRateHistory::userWise()->paginate(20);
    }

    public function detail($id)
    {
        return ExchangeRateHistory::find($id);
    }

    public function list()
    {
        // TODO: Implement list() method.
    }
}
