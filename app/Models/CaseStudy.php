<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    protected $fillable = [
        'title',
        'sections',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sections' => 'array',
    ];

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
