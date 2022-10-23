<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ExchangeRateInterface
{
    public function checkRate(Request $request);

}
