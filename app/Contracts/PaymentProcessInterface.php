<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface PaymentProcessInterface
{
    public function makePayment(Request $request);

}
