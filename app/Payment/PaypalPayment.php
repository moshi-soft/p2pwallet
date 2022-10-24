<?php

namespace App\Payment;

use App\Contracts\PayableMethodInterface;

class PaypalPayment implements PayableMethodInterface
{
    public function pay($payableData)
    {
        return 'ok';
        // TODO: Implement makePayment() method.
    }


}
