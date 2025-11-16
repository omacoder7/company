<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'message',
        'is_processed',
    ];

    protected $casts = [
        'is_processed' => 'boolean',
    ];
}
