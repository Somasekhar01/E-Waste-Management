<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeviceCredit extends Model
{
    protected $fillable = [
        'user_id',
        'device_type',
        'model',
        'condition',
        'credit_points',
        'device_details',
        'is_redeemed',
        'redeemed_at'
    ];

    protected $casts = [
        'device_details' => 'array',
        'is_redeemed' => 'boolean',
        'redeemed_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 