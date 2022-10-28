<?php

namespace App\Contracts;

interface NotifiableInterface
{
    public function notifyViaEmail($email,$subject,array $paymentInfo);
}
