<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'translations' => 'required|array|min:1',
            'translations.*' => 'nullable|array',
            'translations.*.title' => 'required_with:translations.*|nullable|string|max:255',
            'translations.en.description' => 'nullable|string',
            'translations.en.problem' => 'nullable|string',
            'translations.en.solution' => 'nullable|string',
            'translations.en.result' => 'nullable|string',
            'translations.*.description' => 'nullable|string',
            'translations.*.problem' => 'nullable|string',
            'translations.*.solution' => 'nullable|string',
            'translations.*.result' => 'nullable|string',
            'order' => [
                'nullable',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    if ($value && $this->input('is_active')) {
                        $exists = Service::where('order', $value)
                            ->where('is_active', true)
                            ->exists();
                        
                        if ($exists) {
                            $fail('Порядок должен быть уникальным среди активных услуг.');
                        }
                    }
                },
            ],
            'is_active' => 'boolean',
        ];
    }
    
    public function messages()
    {
        return [
            'translations.required' => 'Необходимо заполнить хотя бы один язык.',
            'translations.min' => 'Необходимо заполнить хотя бы один язык.',
            'translations.*.title.required_with' => 'Если вы заполняете язык, название обязательно.',
        ];
    }
    
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $translations = $this->input('translations', []);
            $hasTitle = false;
            
            foreach (['ru', 'en', 'az'] as $locale) {
                if (!empty($translations[$locale]['title'] ?? '')) {
                    $hasTitle = true;
                    break;
                }
            }
            
            if (!$hasTitle) {
                $validator->errors()->add('translations', 'Необходимо заполнить название хотя бы на одном языке.');
            }
        });
    }
}

