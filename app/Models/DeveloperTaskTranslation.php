<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeveloperTaskTranslation extends Model
{
    protected $fillable = [
        'developer_task_id',
        'locale',
        'title',
        'description',
    ];

    public $timestamps = false;
}

