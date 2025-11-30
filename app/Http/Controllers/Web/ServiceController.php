<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('translations')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        return view('web.services', compact('services'));
    }
}

