<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function index()
    {
        $content = PageContent::with('translations')->get()->groupBy('page');
        
        // Создаем удобный массив для формы с переводами
        $formData = [];
        foreach ($content as $page => $items) {
            foreach ($items as $item) {
                foreach (['ru', 'en', 'az'] as $locale) {
                    $translation = $item->translation($locale);
                    $formData[$page . '_' . $item->section . '_' . $locale] = $translation ? $translation->content : '';
                }
            }
        }
        
        return view('admin.pages', compact('content', 'formData'));
    }
    
    public function update(Request $request)
    {
        $data = $request->except('_token');
        
        foreach ($data as $key => $value) {
            // Формат ключа: page_section_locale
            // Разделяем по последнему подчеркиванию, чтобы получить locale
            $lastUnderscorePos = strrpos($key, '_');
            if ($lastUnderscorePos === false) {
                continue;
            }
            
            $locale = substr($key, $lastUnderscorePos + 1);
            
            // Проверяем, что locale валидный
            if (!in_array($locale, ['ru', 'en', 'az'])) {
                continue;
            }
            
            // Оставшаяся часть: page_section (section может содержать подчеркивания)
            $keyWithoutLocale = substr($key, 0, $lastUnderscorePos);
            
            // Разделяем по первому подчеркиванию: page и section
            $firstUnderscorePos = strpos($keyWithoutLocale, '_');
            if ($firstUnderscorePos === false) {
                continue;
            }
            
            $page = substr($keyWithoutLocale, 0, $firstUnderscorePos);
            $section = substr($keyWithoutLocale, $firstUnderscorePos + 1);
            
            // Найти или создать PageContent
            $pageContent = PageContent::firstOrCreate(
                ['page' => $page, 'section' => $section]
            );
            
            // Сохранить перевод
            $pageContent->saveTranslation($locale, ['content' => $value]);
        }
        
        return back()->with('success', 'Контент обновлен');
    }
}

