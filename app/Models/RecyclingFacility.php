<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecyclingFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'phone',
        'hours',
        'services'
    ];

    protected $casts = [
        'services' => 'json',
        'latitude' => 'float',
        'longitude' => 'float'
    ];

    public function recyclingHistory(): HasMany
    {
        return $this->hasMany(RecyclingHistory::class, 'facility_id');
    }
} 