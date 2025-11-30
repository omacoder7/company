<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CaseStudy extends Model
{
    use Translatable;

    protected $fillable = [
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all translations for this case study
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CaseStudyTranslation::class);
    }

    /**
     * Get translated title
     */
    public function getTitle($locale = null)
    {
        return $this->getTranslatedAttribute('title', $locale);
    }

    /**
     * Get translated sections
     */
    public function getSections($locale = null)
    {
        $translated = $this->getTranslatedAttribute('sections', $locale);
        if ($translated) {
            return is_string($translated) ? json_decode($translated, true) : $translated;
        }
        return [];
    }

    /**
     * Accessor for title (uses current locale)
     */
    public function getTitleAttribute()
    {
        return $this->getTitle();
    }

    /**
     * Accessor for sections (uses current locale)
     */
    public function getSectionsAttribute()
    {
        return $this->getSections();
    }

    public function flexibleSections(): array
    {
        return $this->sections ?? [];
    }

    public function getPrimaryDetailsAttribute(): array
    {
        foreach ($this->flexibleSections() as $section) {
            if (($section['type'] ?? null) === 'details' && !empty($section['details'])) {
                return $section['details'];
            }
        }

        return [];
    }

    public function getSummaryAttribute(): ?string
    {
        foreach ($this->flexibleSections() as $section) {
            $type = $section['type'] ?? 'text';

            if ($type === 'details') {
                continue;
            }

            if ($type === 'list' && !empty($section['items'])) {
                $items = array_map(fn ($item) => trim(strip_tags($item)), $section['items']);
                $items = array_values(array_filter($items));

                if (!empty($items)) {
                    return implode(' • ', array_slice($items, 0, 3));
                }
            }

            $content = trim(strip_tags($section['content'] ?? ''));
            if ($content !== '') {
                return $content;
            }
        }

        return null;
    }

}
