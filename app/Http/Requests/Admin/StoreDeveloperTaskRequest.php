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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
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
}

