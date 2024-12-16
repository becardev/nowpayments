<?php

namespace Shopia\Nowpayments\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = [
        'sandbox_api_key',
        'live_api_key',
        'sandbox_mode',
        'default_currency',
    ];

    protected $casts = [
        'sandbox_mode' => 'boolean',
    ];
}
