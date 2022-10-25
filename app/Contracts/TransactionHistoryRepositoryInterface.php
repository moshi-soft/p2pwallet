<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface TransactionHistoryRepositoryInterface
{
    public function create(
        int    $transaction_by, int $transaction_to, string $transaction_from_currency,
        string $transaction_to_currency, float $transaction_rate, float $applied_amount,
        float  $converted_amount
    );

    public function listByUser();

    public function list();

    public function detail($id);
}
