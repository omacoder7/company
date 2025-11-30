<?php

namespace App\Traits;

trait Translatable
{
    /**
     * Get the translation for the current locale
     */
    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        
        // If translations are already loaded, use them
        if ($this->relationLoaded('translations')) {
            return $this->translations->firstWhere('locale', $locale);
        }
        
        // Otherwise, query the database
        return $this->translations()->where('locale', $locale)->first();
    }

    /**
     * Get attribute with translation fallback
     */
    public function getTranslatedAttribute($attribute, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $translation = $this->translation($locale);
        
        if ($translation && isset($translation->$attribute)) {
            return $translation->$attribute;
        }
        
        // Fallback to default locale
        $defaultTranslation = $this->translation(config('app.fallback_locale'));
        if ($defaultTranslation && isset($defaultTranslation->$attribute)) {
            return $defaultTranslation->$attribute;
        }
        
        return null;
    }

    /**
     * Save translation for a locale
     */
    public function saveTranslation($locale, array $data)
    {
        // Ensure all values are properly set - remove nulls but keep empty arrays
        $filteredData = [];
        foreach ($data as $key => $value) {
            // Keep all non-null values (including empty arrays)
            if ($value !== null) {
                $filteredData[$key] = $value;
            }
        }
        
        // Get the foreign key name from the relationship
        $relation = $this->translations();
        $foreignKey = $relation->getForeignKeyName();
        
        // Add foreign key and locale
        $filteredData[$foreignKey] = $this->id;
        $filteredData['locale'] = $locale;
        
        // Use updateOrCreate
        return $this->translations()->updateOrCreate(
            ['locale' => $locale],
            $filteredData
        );
    }
}

