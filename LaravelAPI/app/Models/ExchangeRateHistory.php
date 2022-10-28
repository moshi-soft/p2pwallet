<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRateHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'requested_date',
        'rate',
        'amount',
        'converted_amount',
        'currency_from',
        'currency_to',
        'user_id',
        'rate_datetime',
        'success',
        'exchangeRateJson',
    ];
    public function scopeUserWise($query)
    {
        return $query->where('user_id', '=',auth()->id());
    }

    protected static function boot()
    {
        parent::boot();
        if (auth()->check()) {
            self::creating(function ($model) {
                $model->user_id = auth()->id();
                $model->rate_datetime = Carbon::createFromTimestamp($model->rate_datetime)->format('Y-m-d H:i:s');
                $model->exchangeRateJson = json_encode($model->exchangeRateJson);
            });
        }
    }
}
