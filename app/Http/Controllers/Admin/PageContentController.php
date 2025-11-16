<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function index()
    {
        $content = PageContent::all()->groupBy('page');
        
        // Создаем удобный массив для формы
        $formData = [];
        foreach ($content as $page => $items) {
            foreach ($items as $item) {
                $formData[$page . '_' . $item->section] = $item->content;
            }
        }
        
        return view('admin.pages', compact('content', 'formData'));
    }
    
    public function update(Request $request)
    {
        $data = $request->except('_token');
        
        foreach ($data as $key => $value) {
            [$page, $section] = explode('_', $key, 2);
            PageContent::updateOrCreate(
                ['page' => $page, 'section' => $section],
                ['content' => $value]
            );
        }
        
        return back()->with('success', 'Контент обновлен');
    }
}

