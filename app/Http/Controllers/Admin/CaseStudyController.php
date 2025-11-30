<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCaseStudyRequest;
use App\Http\Requests\Admin\UpdateCaseStudyRequest;
use App\Models\CaseStudy;
use Illuminate\Support\Facades\Storage;

class CaseStudyController extends Controller
{
    public function index()
    {
        $cases = CaseStudy::orderBy('order')->get();

        return view('admin.cases.index', compact('cases'));
    }
    
    public function create()
    {
        return view('admin.cases.create');
    }
    
    public function store(StoreCaseStudyRequest $request)
    {
        $validated = $request->validated();
        
        // Extract translation data
        $translations = $validated['translations'] ?? [];
        unset($validated['translations']);
        
        // Handle image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cases', 'public');
        }
        
        // Create case study
        $case = CaseStudy::create($validated);
        
        // Save translations
        foreach (['ru', 'en', 'az'] as $locale) {
            if (isset($translations[$locale])) {
                $translationData = [
                    'title' => $translations[$locale]['title'] ?? '',
                    'sections' => $this->normalizeSections($translations[$locale]['sections'] ?? []),
                ];
                $case->saveTranslation($locale, $translationData);
            }
        }
        
        return redirect()->route('admin.cases.index')->with('success', 'Кейс создан');
    }
    
    public function show($id)
    {
        return $this->edit($id);
    }
    
    public function edit($id)
    {
        $case = CaseStudy::with('translations')->findOrFail($id);
        
        // Prepare translations data for form
        $translations = [];
        foreach (['ru', 'en', 'az'] as $locale) {
            $translation = $case->translation($locale);
            $translations[$locale] = [
                'title' => $translation ? $translation->title : '',
                'sections' => $translation && $translation->sections ? $translation->sections : [],
            ];
        }
        
        return view('admin.cases.edit', compact('case', 'translations'));
    }
    
    public function update(UpdateCaseStudyRequest $request, $id)
    {
        $case = CaseStudy::findOrFail($id);
        $validated = $request->validated();
        
        // Extract translation data
        $translations = $validated['translations'] ?? [];
        unset($validated['translations']);
        
        // Handle image
        if ($request->hasFile('image')) {
            if ($case->image) {
                Storage::disk('public')->delete($case->image);
            }
            $validated['image'] = $request->file('image')->store('cases', 'public');
        }
        
        // Update case study
        $case->update($validated);
        
        // Save translations
        foreach (['ru', 'en', 'az'] as $locale) {
            if (isset($translations[$locale])) {
                $translationData = [
                    'title' => $translations[$locale]['title'] ?? '',
                    'sections' => $this->normalizeSections($translations[$locale]['sections'] ?? []),
                ];
                $case->saveTranslation($locale, $translationData);
            }
        }
        
        return redirect()->route('admin.cases.index')->with('success', 'Кейс обновлен');
    }
    
    public function destroy($id)
    {
        $case = CaseStudy::findOrFail($id);
        if ($case->image) {
            Storage::disk('public')->delete($case->image);
        }
        $case->delete();
        return back()->with('success', 'Кейс удален');
    }

    private function normalizeSections(array $sections = []): array
    {
        if (empty($sections)) {
            return [];
        }

        return collect($sections)
            ->map(function ($section) {
                $type = $section['type'] ?? 'text';
                $title = trim($section['title'] ?? '');
                $content = null;
                $items = [];
                $details = [];

                if ($type === 'list') {
                    $items = collect(preg_split("/\r\n|\n|\r/", $section['items'] ?? ''))
                        ->map(fn ($item) => trim($item))
                        ->filter()
                        ->values()
                        ->all();
                } elseif ($type === 'details') {
                    $details = collect($section['details'] ?? [])
                        ->map(function ($detail) {
                            return [
                                'label' => trim($detail['label'] ?? ''),
                                'value' => trim($detail['value'] ?? ''),
                            ];
                        })
                        ->filter(function ($detail) {
                            return $detail['label'] !== '' || $detail['value'] !== '';
                        })
                        ->values()
                        ->all();
                } else {
                    $type = 'text';
                    $content = trim($section['content'] ?? '');
                }

                return [
                    'title' => $title,
                    'type' => $type,
                    'content' => $type === 'text' ? $content : null,
                    'items' => $type === 'list' ? $items : [],
                    'details' => $type === 'details' ? $details : [],
                ];
            })
            ->filter(function ($section) {
                if ($section['type'] === 'list') {
                    return $section['title'] !== '' || !empty($section['items']);
                }

                if ($section['type'] === 'details') {
                    return $section['title'] !== '' || !empty($section['details']);
                }

                return $section['title'] !== '' || $section['content'] !== '';
            })
            ->values()
            ->all();
    }
}

