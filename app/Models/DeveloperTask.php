<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeveloperTask extends Model
{
    protected $fillable = [
        'title',
        'description',
        'stack',
        'format',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
