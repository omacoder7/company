<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeveloperTaskRequest;
use App\Http\Requests\Admin\UpdateDeveloperTaskRequest;
use App\Models\DeveloperTask;

class DeveloperTaskController extends Controller
{
    public function index()
    {
        $tasks = DeveloperTask::orderBy('order')->get();
        return view('admin.developer-tasks.index', compact('tasks'));
    }
    
    public function create()
    {
        return view('admin.developer-tasks.create');
    }
    
    public function store(StoreDeveloperTaskRequest $request)
    {
        $validated = $request->validated();
        
        // Extract translation data
        $translations = $validated['translations'] ?? [];
        unset($validated['translations']);
        
        // Create task
        $task = DeveloperTask::create($validated);
        
        // Save translations
        foreach (['ru', 'en', 'az'] as $locale) {
            if (isset($translations[$locale])) {
                $task->saveTranslation($locale, $translations[$locale]);
            }
        }
        
        return redirect()->route('admin.developer-tasks.index')->with('success', 'Задача создана');
    }
    
    public function show($id)
    {
        return $this->edit($id);
    }
    
    public function edit($id)
    {
        $task = DeveloperTask::with('translations')->findOrFail($id);
        
        // Prepare translations data for form
        $translations = [];
        foreach (['ru', 'en', 'az'] as $locale) {
            $translation = $task->translation($locale);
            $translations[$locale] = [
                'title' => $translation ? $translation->title : '',
                'description' => $translation ? $translation->description : '',
            ];
        }
        
        return view('admin.developer-tasks.edit', compact('task', 'translations'));
    }
    
    public function update(UpdateDeveloperTaskRequest $request, $id)
    {
        $task = DeveloperTask::findOrFail($id);
        $validated = $request->validated();
        
        // Extract translation data
        $translations = $validated['translations'] ?? [];
        unset($validated['translations']);
        
        // Update task
        $task->update($validated);
        
        // Save translations
        foreach (['ru', 'en', 'az'] as $locale) {
            if (isset($translations[$locale])) {
                $task->saveTranslation($locale, $translations[$locale]);
            }
        }
        
        return redirect()->route('admin.developer-tasks.index')->with('success', 'Задача обновлена');
    }
    
    public function destroy($id)
    {
        DeveloperTask::findOrFail($id)->delete();
        return back()->with('success', 'Задача удалена');
    }
}

