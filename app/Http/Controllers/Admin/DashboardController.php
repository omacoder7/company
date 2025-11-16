<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\CaseStudy;
use App\Models\DeveloperTask;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services' => Service::count(),
            'cases' => CaseStudy::count(),
            'tasks' => DeveloperTask::count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
}

