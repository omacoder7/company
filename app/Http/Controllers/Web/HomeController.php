<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\CaseStudy;
use App\Models\PageContent;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::with('translations')
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(6)
            ->get();
            
        $cases = CaseStudy::with('translations')
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(6)
            ->get();
            
        // Get page content with translations
        $pageContents = PageContent::with('translations')
            ->where('page', 'home')
            ->get();
            
        $content = [];
        foreach ($pageContents as $pageContent) {
            $content[$pageContent->section] = $pageContent->content;
        }
            
        return view('web.home', compact('services', 'cases', 'content'));
    }
}

