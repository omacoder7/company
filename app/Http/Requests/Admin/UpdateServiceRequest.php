<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
        $serviceId = $this->route('id') ?? $this->route('service') ?? $this->route()->parameter('id') ?? $this->route()->parameter('service');
        
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'problem' => 'nullable|string',
            'solution' => 'nullable|string',
            'result' => 'nullable|string',
            'order' => [
                'nullable',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($serviceId) {
                    if ($value && $this->input('is_active')) {
                        $exists = Service::where('order', $value)
                            ->where('is_active', true)
                            ->where('id', '!=', $serviceId)
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
}

