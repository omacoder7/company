<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use Translatable;

    protected $fillable = [
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all translations for this service
     */
    public function translations(): HasMany
    {
        return $this->hasMany(ServiceTranslation::class);
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
     * Get translated problem
     */
    public function getProblem($locale = null)
    {
        return $this->getTranslatedAttribute('problem', $locale);
    }

    /**
     * Get translated solution
     */
    public function getSolution($locale = null)
    {
        return $this->getTranslatedAttribute('solution', $locale);
    }

    /**
     * Get translated result
     */
    public function getResult($locale = null)
    {
        return $this->getTranslatedAttribute('result', $locale);
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

    /**
     * Accessor for problem (uses current locale)
     */
    public function getProblemAttribute()
    {
        return $this->getProblem();
    }

    /**
     * Accessor for solution (uses current locale)
     */
    public function getSolutionAttribute()
    {
        return $this->getSolution();
    }

    /**
     * Accessor for result (uses current locale)
     */
    public function getResultAttribute()
    {
        return $this->getResult();
    }
}
