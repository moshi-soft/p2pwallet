<?php

namespace App\Payment;

use App\Contracts\PayableMethodInterface;

class P2PPayment implements PayableMethodInterface
{
    public function payFrom($from, $to, $convertedAmount, $currency, $action_type)
    {
        // TODO: Implement payFrom() method.
    }
    public function payTo($from, $to, $convertedAmount, $currency, $action_type)
    {
        return 'ok';
        // TODO: Implement makePayment() method.
    }

}
