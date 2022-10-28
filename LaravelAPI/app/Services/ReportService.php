<?php

namespace App\Services;

use App\Contracts\ReportInterface;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportService implements ReportInterface
{
    public function whoConvertedMost()
    {
        return TransactionHistory::with(['transactionBy' => function ($query) {
            $query->select('id', 'name', 'email');
        }])->select(DB::raw('transaction_by,count(*) as total'))->groupBy('transaction_by')
            ->orderByDesc('total')->first()?->toArray()['transaction_by']['name'] ?? 'N/A';
    }

    public function totalConvertedAmount($user_id)
    {
        return TransactionHistory::with(['transactionBy' => function ($query) {
            $query->select('id', 'name', 'email');
        }])->where('transaction_by', '=', $user_id)->sum('applied_amount');
    }

    public function thirdHighestTransactedAmount($user_id)
    {
        return User::select(['name', 'id'])
            ->addSelect(
                ['applied_amount' => TransactionHistory::select(
                    DB::raw('max(applied_amount)'))
                    ->groupBy('id')
                    ->whereColumn('transaction_histories.transaction_by', 'users.id')
                    ->orderByDesc('applied_amount')
                    ->offset(2)->limit(1)
                ])
            ->where('id', '=', $user_id)
            ->get();
    }
}
