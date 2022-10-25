<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface PayableMethodInterface
{
    public function pay(int $from, int $to, float $amount, float $converted_amount);

//    public function payFrom(int $from, int $to, float $amount, string $currency, string $action_type);
//
//    public function payTo(int $from, int $to, float $convertedAmount, string $currency, string $action_type);

}
