<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContentTranslation extends Model
{
    protected $fillable = [
        'page_content_id',
        'locale',
        'content',
    ];

    public $timestamps = false;
}

