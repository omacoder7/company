<?php

namespace App\Http\Requests\Admin;

use App\Models\CaseStudy;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCaseStudyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {    
        if (!$this->has('is_active')) {
            $this->merge(['is_active' => false]);
        } else {
            $this->merge(['is_active' => true]);
        }
    }

    public function rules()
    {
        $caseId = $this->route('id') ?? $this->route('case') ?? $this->route()->parameter('id') ?? $this->route()->parameter('case');
        
        return [
            'translations' => 'required|array|min:1',
            'translations.*' => 'nullable|array',
            'translations.*.title' => 'required_with:translations.*|nullable|string|max:255',
            'translations.*.sections' => 'nullable|array',
            'translations.*.sections.*.title' => 'nullable|string|max:255',
            'translations.*.sections.*.type' => 'nullable|in:text,list,details',
            'translations.*.sections.*.content' => 'nullable|string',
            'translations.*.sections.*.items' => 'nullable|string',
            'translations.*.sections.*.details' => 'nullable|array',
            'translations.*.sections.*.details.*.label' => 'nullable|string|max:255',
            'translations.*.sections.*.details.*.value' => 'nullable|string',
            'translations.*.sections.*.image' => 'nullable|image|max:2048',
            'image' => 'nullable|image|max:2048',
            'order' => [
                'nullable',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($caseId) {
                    if ($value && $this->input('is_active')) {
                        $exists = CaseStudy::where('order', $value)
                            ->where('is_active', true)
                            ->where('id', '!=', $caseId)
                            ->exists();
                        
                        if ($exists) {
                            $fail('Порядок должен быть уникальным среди активных кейсов.');
                        }
                    }
                },
            ],
            'is_active' => 'boolean',
        ];
    }
}
