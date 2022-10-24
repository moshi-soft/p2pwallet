<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface PayableMethodInterface
{
    public function payFrom($from, $to, $convertedAmount, $currency, $action_type);

    public function payTo($from, $to, $convertedAmount, $currency, $action_type);

}
