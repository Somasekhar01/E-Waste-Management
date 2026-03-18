<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalResource extends Model
{
    protected $fillable = [
        'title',
        'content',
        'type',
        'media_url',
        'thumbnail',
        'tags',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];
} 