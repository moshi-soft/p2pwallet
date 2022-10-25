<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ExchangeRateHistoryRepositoryInterface
{
    public function create($request_date, $rate, $amount, $converted_amount, $currency_from, $currency_to,
                           $rate_datetime, $isSuccess, $json);

    public function listByUser();

    public function list();

    public function detail($id);
}
