<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ExchangeRateInterface
{
    public function checkRate($amount, $from_currency, $to_currency);
}
