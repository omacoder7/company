<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PageContent;

class AboutController extends Controller
{
    public function index()
    {
        $pageContents = PageContent::with('translations')
            ->where('page', 'about')
            ->get();
            
        $content = [];
        foreach ($pageContents as $pageContent) {
            $content[$pageContent->section] = $pageContent->content;
        }
            
        return view('web.about', compact('content'));
    }
}

