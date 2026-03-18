<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecyclingHistory extends Model
{
    protected $table = 'recycling_history';

    protected $fillable = [
        'user_id',
        'facility_id',
        'recycling_date',
        'device_type',
        'quantity',
        'carbon_footprint_reduction',
        'notes'
    ];

    protected $casts = [
        'recycling_date' => 'date',
        'carbon_footprint_reduction' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(RecyclingFacility::class, 'facility_id');
    }
} 