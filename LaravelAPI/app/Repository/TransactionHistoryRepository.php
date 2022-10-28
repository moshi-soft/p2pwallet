<?php

namespace App\Repository;

use App\Contracts\TransactionHistoryRepositoryInterface;
use App\Models\TransactionHistory;

class TransactionHistoryRepository implements TransactionHistoryRepositoryInterface
{

    public function create(
        int    $transaction_by, int $transaction_to, string $transaction_from_currency,
        string $transaction_to_currency, float $transaction_rate, float $applied_amount,
        float  $converted_amount
    )
    {
        return TransactionHistory::create([
            'transaction_by' => $transaction_by, 'transaction_to' => $transaction_to,
            'transaction_from_currency' => $transaction_from_currency,
            'transaction_to_currency' => $transaction_to_currency,
            'transaction_rate' => $transaction_rate, 'applied_amount' => $applied_amount,
            'converted_amount' => $converted_amount
        ]);
    }

    public function listByUser()
    {
    }

    public function detail($id)
    {
    }

    public function list()
    {
        // TODO: Implement list() method.
    }
}
