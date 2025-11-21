<?php

namespace App\Http\Requests\Admin;

use App\Models\CaseStudy;
use Illuminate\Foundation\Http\FormRequest;

class StoreCaseStudyRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'sections' => 'nullable|array',
            'sections.*.title' => 'nullable|string|max:255',
            'sections.*.type' => 'nullable|in:text,list,details',
            'sections.*.content' => 'nullable|string',
            'sections.*.items' => 'nullable|string',
            'sections.*.details' => 'nullable|array',
            'sections.*.details.*.label' => 'nullable|string|max:255',
            'sections.*.details.*.value' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => [
                'nullable',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    if ($value && $this->input('is_active')) {
                        $exists = CaseStudy::where('order', $value)
                            ->where('is_active', true)
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

