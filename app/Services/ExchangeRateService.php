<?php

namespace App\Services;

use App\Contracts\ExchangeRateInterface;
use App\Contracts\PaymentInterface;
use Illuminate\Http\Request;

class ExchangeRateService implements ExchangeRateInterface
{


    public function checkRate($amount, $from_currency, $to_currency, $date)
    {
        // TODO: Implement checkRate() method.
    }
}
