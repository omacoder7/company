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
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->limit(6)
            ->get();
            
        $cases = CaseStudy::where('is_active', true)
            ->orderBy('order')
            ->limit(6)
            ->get();
            
        $content = PageContent::where('page', 'home')
            ->pluck('content', 'section')
            ->toArray();
            
        return view('web.home', compact('services', 'cases', 'content'));
    }
}

