<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ReportInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(protected ReportInterface $report)
    {
    }

    public function mostConvertedUser()
    {
        return $this->report->whoConvertedMost();
    }
    public function totalConvertedAmount($user_id)
    {
        return $this->report->totalConvertedAmount($user_id);
    }
    public function thirdHighestTransactedAmount($user_id)
    {
        return $this->report->thirdHighestTransactedAmount($user_id);
    }
}
