<?php

namespace App\Payment;

use App\Contracts\PayableMethodInterface;

class PaypalPayment implements PayableMethodInterface
{
    public function payFrom(int $from, int $to, float $amount, string $currency, string $action_type)
    {
        // TODO: Implement payFrom() method.
    }

    public function payTo(int $from, int $to, float $convertedAmount, string $currency, string $action_type)
    {
        // TODO: Implement payTo() method.
    }
}
