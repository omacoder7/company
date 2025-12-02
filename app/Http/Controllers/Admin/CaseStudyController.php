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
        $translationsInput = $request->input('translations', []);
        unset($validated['translations']);

        foreach (['ru', 'en', 'az'] as $locale) {
            if (!empty($translationsInput[$locale]['sections'])) {
                foreach ($translationsInput[$locale]['sections'] as $index => $section) {
                    if ($request->hasFile("translations.$locale.sections.$index.image")) {
                        $path = $request->file("translations.$locale.sections.$index.image")
                            ->store('cases/sections', 'public');
                        $translationsInput[$locale]['sections'][$index]['image'] = $path;
                    }
                }
            }
        }

        $translationsInput = $this->syncSectionImagesAcrossLocales($translationsInput);
        
        // Handle image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cases', 'public');
        }
        
        // Create case study
        $case = CaseStudy::create($validated);
        
        // Save translations
        foreach (['ru', 'en', 'az'] as $locale) {
            if (isset($translationsInput[$locale])) {
                $translationData = [
                    'title' => $translationsInput[$locale]['title'] ?? '',
                    'sections' => $this->normalizeSections($translationsInput[$locale]['sections'] ?? []),
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
        
        $translationsInput = $request->input('translations', []);
        unset($validated['translations']);

        foreach (['ru', 'en', 'az'] as $locale) {
            if (!empty($translationsInput[$locale]['sections'])) {
                foreach ($translationsInput[$locale]['sections'] as $index => $section) {
                    $existingImage = $section['existing_image'] ?? null;
                    $removeImage = !empty($section['remove_image']);

                    if ($request->hasFile("translations.$locale.sections.$index.image")) {
                        if ($existingImage) {
                            Storage::disk('public')->delete($existingImage);
                        }

                        $path = $request->file("translations.$locale.sections.$index.image")
                            ->store('cases/sections', 'public');
                        $translationsInput[$locale]['sections'][$index]['image'] = $path;
                    } elseif ($removeImage) {
                        if ($existingImage) {
                            Storage::disk('public')->delete($existingImage);
                        }
                        $translationsInput[$locale]['sections'][$index]['image'] = null;
                    } else {
                        $translationsInput[$locale]['sections'][$index]['image'] = $existingImage;
                    }
                }
            }
        }

        // После обработки existing/remove синхронизируем изображения между локалями
        $translationsInput = $this->syncSectionImagesAcrossLocales($translationsInput);
        
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
            if (isset($translationsInput[$locale])) {
                $translationData = [
                    'title' => $translationsInput[$locale]['title'] ?? '',
                    'sections' => $this->normalizeSections($translationsInput[$locale]['sections'] ?? []),
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

    /**
     * Синхронизирует изображения секций между локалями:
     * если в каком-то языке для секции с индексом N есть image,
     * он копируется в секции с тем же индексом в других языках, если там image пустой.
     */
    private function syncSectionImagesAcrossLocales(array $translationsInput): array
    {
        $locales = ['ru', 'en', 'az'];

        // Определяем максимальное количество секций среди всех локалей
        $maxSections = 0;
        foreach ($locales as $locale) {
            $count = count($translationsInput[$locale]['sections'] ?? []);
            if ($count > $maxSections) {
                $maxSections = $count;
            }
        }

        if ($maxSections === 0) {
            return $translationsInput;
        }

        // По каждому индексу ищем "эталонное" изображение и подставляем в пустые
        for ($index = 0; $index < $maxSections; $index++) {
            $imagePath = null;

            // Сначала ищем любое непустое изображение среди локалей
            foreach ($locales as $locale) {
                if (!empty($translationsInput[$locale]['sections'][$index]['image'] ?? null)) {
                    $imagePath = $translationsInput[$locale]['sections'][$index]['image'];
                    break;
                }
            }

            if (!$imagePath) {
                continue;
            }

            // Копируем найденный путь в остальные локали, где секция есть, но image пустой
            foreach ($locales as $locale) {
                if (isset($translationsInput[$locale]['sections'][$index])) {
                    if (empty($translationsInput[$locale]['sections'][$index]['image'])) {
                        $translationsInput[$locale]['sections'][$index]['image'] = $imagePath;
                    }
                }
            }
        }

        return $translationsInput;
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
                $image = $section['image'] ?? null;

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
                    'image' => $image,
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

