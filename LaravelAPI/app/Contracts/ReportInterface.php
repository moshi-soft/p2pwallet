<?php

namespace App\Contracts;

interface ReportInterface
{
    public function whoConvertedMost();

    public function totalConvertedAmount($user_id);

    public function thirdHighestTransactedAmount($user_id);
}
