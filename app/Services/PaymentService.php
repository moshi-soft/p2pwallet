<?php

namespace App\Services;

use App\Contracts\PaymentInterface;
use App\Payment\P2PPayment;
use App\Payment\PaypalPayment;
use Illuminate\Http\Request;

class PaymentService implements PaymentInterface
{

    public function init(string $payment_type)
    {
        return match ($payment_type){
            env('PAYMENT_METHOD_P2P') => new P2PPayment(),
            env('PAYMENT_METHOD_PAYPAL') => new PaypalPayment()
        };
    }
}
