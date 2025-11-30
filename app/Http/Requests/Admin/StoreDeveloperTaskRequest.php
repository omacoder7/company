<?php

namespace App\Http\Requests\Admin;

use App\Models\DeveloperTask;
use Illuminate\Foundation\Http\FormRequest;

class StoreDeveloperTaskRequest extends FormRequest
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
            'translations.*.description' => 'nullable|string',
            'stack' => 'nullable|string|max:255',
            'format' => 'nullable|string|max:255',
            'order' => [
                'nullable',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    if ($value && $this->input('is_active')) {
                        $exists = DeveloperTask::where('order', $value)
                            ->where('is_active', true)
                            ->exists();
                        
                        if ($exists) {
                            $fail('Порядок должен быть уникальным среди активных задач.');
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
