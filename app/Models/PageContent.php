<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageContent extends Model
{
    use Translatable;

    protected $fillable = [
        'page',
        'section',
    ];

    /**
     * Get all translations for this page content
     */
    public function translations(): HasMany
    {
        return $this->hasMany(PageContentTranslation::class);
    }

    /**
     * Get translated content
     */
    public function getContent($locale = null)
    {
        return $this->getTranslatedAttribute('content', $locale);
    }

    /**
     * Accessor for content (uses current locale)
     */
    public function getContentAttribute()
    {
        return $this->getContent();
    }
}
