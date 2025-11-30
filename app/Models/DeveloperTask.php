<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeveloperTask extends Model
{
    use Translatable;

    protected $fillable = [
        'stack',
        'format',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all translations for this developer task
     */
    public function translations(): HasMany
    {
        return $this->hasMany(DeveloperTaskTranslation::class);
    }

    /**
     * Get translated title
     */
    public function getTitle($locale = null)
    {
        return $this->getTranslatedAttribute('title', $locale);
    }

    /**
     * Get translated description
     */
    public function getDescription($locale = null)
    {
        return $this->getTranslatedAttribute('description', $locale);
    }

    /**
     * Accessor for title (uses current locale)
     */
    public function getTitleAttribute()
    {
        return $this->getTitle();
    }

    /**
     * Accessor for description (uses current locale)
     */
    public function getDescriptionAttribute()
    {
        return $this->getDescription();
    }
}
