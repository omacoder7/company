<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeveloperApplication extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'stack',
        'github',
        'portfolio',
        'message',
        'is_processed',
    ];

    protected $casts = [
        'is_processed' => 'boolean',
    ];
}
