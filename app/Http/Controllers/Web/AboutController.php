<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PageContent;

class AboutController extends Controller
{
    public function index()
    {
        $content = PageContent::where('page', 'about')
            ->pluck('content', 'section')
            ->toArray();
            
        return view('web.about', compact('content'));
    }
}

