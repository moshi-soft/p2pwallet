<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWallet extends Model
{
    use HasFactory;
    protected $table='user_wallet';

    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'action_type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_d', 'id');
    }
}
