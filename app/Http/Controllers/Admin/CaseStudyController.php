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
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cases', 'public');
        }
        
        CaseStudy::create($validated);
        return redirect()->route('admin.cases.index')->with('success', 'Кейс создан');
    }
    
    public function show($id)
    {
        return $this->edit($id);
    }
    
    public function edit($id)
    {
        $case = CaseStudy::findOrFail($id);
        return view('admin.cases.edit', compact('case'));
    }
    
    public function update(UpdateCaseStudyRequest $request, $id)
    {
        $case = CaseStudy::findOrFail($id);
        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            if ($case->image) {
                Storage::disk('public')->delete($case->image);
            }
            $validated['image'] = $request->file('image')->store('cases', 'public');
        }
        
        $case->update($validated);
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
}

