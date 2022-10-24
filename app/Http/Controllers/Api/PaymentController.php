<?php

namespace App\Http\Controllers\Api;

use App\Contracts\NotifiableInterface;
use App\Contracts\PaymentInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentRequest;

class PaymentController extends Controller
{
    public function pay(PaymentRequest $paymentRequest, PaymentInterface $payment, NotifiableInterface $notifiable)
    {
        $input = $paymentRequest->validated();
        $input['payment_type'] = env('PAYMENT_METHOD_P2P');
        // Eloquent to get user wallet detail
        // validate if balance available
        // check rate
        // db transaction start
        // exchange rate histories
        // initialize payment
        // pay to // update wallet
        // pay from // update wallet
        // update transaction history
        // update wallet history
        // db transaction end

        $paymentMethod = $payment->init($input['payment_type']);

        $paymentMethod->payTo();
        $paymentMethod->payFrom();
        //dd($paymentMethod);
        //$paymentMethod->
    }
}
