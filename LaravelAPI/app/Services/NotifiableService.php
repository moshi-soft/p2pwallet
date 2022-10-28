<?php

namespace App\Services;

use App\Contracts\NotifiableInterface;

class NotifiableService implements NotifiableInterface
{
    public function notifyViaEmail($email,$subject,array $paymentInfo)
    {
        // TODO: Implement notifyViaEmail() method.
    }
}
