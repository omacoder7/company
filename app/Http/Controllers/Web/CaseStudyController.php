<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;

class CaseStudyController extends Controller
{
    public function index()
    {
        $cases = CaseStudy::with('translations')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        return view('web.cases', compact('cases'));
    }
    
    public function show($locale, $id)
    {
        $case = CaseStudy::with('translations')
            ->findOrFail($id);
        
        return view('web.case-detail', compact('case'));
    }
}

