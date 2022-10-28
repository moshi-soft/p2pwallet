<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface PaymentInterface
{
    public function init(string $payment_type);

}
