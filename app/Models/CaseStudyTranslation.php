<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudyTranslation extends Model
{
    protected $fillable = [
        'case_study_id',
        'locale',
        'title',
        'sections',
    ];

    protected $casts = [
        'sections' => 'array',
    ];

    public $timestamps = false;
}

