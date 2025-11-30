<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }
    
    public function create()
    {
        $translations = [
            'en' => ['title' => '', 'description' => '', 'problem' => '', 'solution' => '', 'result' => ''],
            'ru' => ['title' => '', 'description' => '', 'problem' => '', 'solution' => '', 'result' => ''],
            'az' => ['title' => '', 'description' => '', 'problem' => '', 'solution' => '', 'result' => ''],
        ];
        return view('admin.services.create', compact('translations'));
    }
    
    public function store(StoreServiceRequest $request)
    {
        $validated = $request->validated();
        
        // Extract translation data
        $translations = $validated['translations'] ?? [];
        unset($validated['translations']);
        
        // Create service
        $service = Service::create($validated);
        
        // Save translations
        foreach (['en', 'ru', 'az'] as $locale) {
            if (isset($translations[$locale])) {
                $service->saveTranslation($locale, $translations[$locale]);
            }
        }
        
        return redirect()->route('admin.services.index')->with('success', 'Услуга создана');
    }
    
    public function show($id)
    {
        return $this->edit($id);
    }
    
    public function edit($id)
    {
        $service = Service::with('translations')->findOrFail($id);
        
        // Prepare translations data for form
        $translations = [];
        foreach (['en', 'ru', 'az'] as $locale) {
            $translation = $service->translation($locale);
            $translations[$locale] = [
                'title' => $translation ? $translation->title : '',
                'description' => $translation ? $translation->description : '',
                'problem' => $translation ? $translation->problem : '',
                'solution' => $translation ? $translation->solution : '',
                'result' => $translation ? $translation->result : '',
            ];
        }
        
        return view('admin.services.edit', compact('service', 'translations'));
    }
    
    public function update(UpdateServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $validated = $request->validated();
        
        // Extract translation data
        $translations = $validated['translations'] ?? [];
        unset($validated['translations']);
        
        // Update service
        $service->update($validated);
        
        // Save translations
        foreach (['en', 'ru', 'az'] as $locale) {
            if (isset($translations[$locale])) {
                $service->saveTranslation($locale, $translations[$locale]);
            }
        }
        
        return redirect()->route('admin.services.index')->with('success', 'Услуга обновлена');
    }
    
    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return back()->with('success', 'Услуга удалена');
    }
}

