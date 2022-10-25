<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_by', 'transaction_to', 'transaction_from_currency', 'transaction_to_currency', 'transaction_rate',
        'applied_amount', 'converted_amount'
    ];

    public function transactionBy(): belongsTo
    {
        return $this->belongsTo(User::class, 'transaction_by', 'id');
    }

    public function transactionTo(): belongsTo
    {
        return $this->belongsTo(User::class, 'transaction_to', 'id');
    }

}
