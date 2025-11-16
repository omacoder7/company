<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeveloperTaskRequest;
use App\Http\Requests\Admin\UpdateDeveloperTaskRequest;
use App\Models\DeveloperTask;

class DeveloperTaskController extends Controller
{
    public function index()
    {
        $tasks = DeveloperTask::orderBy('order')->get();
        return view('admin.developer-tasks.index', compact('tasks'));
    }
    
    public function create()
    {
        return view('admin.developer-tasks.create');
    }
    
    public function store(StoreDeveloperTaskRequest $request)
    {
        DeveloperTask::create($request->validated());
        return redirect()->route('admin.developer-tasks.index')->with('success', 'Задача создана');
    }
    
    public function show($id)
    {
        return $this->edit($id);
    }
    
    public function edit($id)
    {
        $task = DeveloperTask::findOrFail($id);
        return view('admin.developer-tasks.edit', compact('task'));
    }
    
    public function update(UpdateDeveloperTaskRequest $request, $id)
    {
        $task = DeveloperTask::findOrFail($id);
        $task->update($request->validated());
        return redirect()->route('admin.developer-tasks.index')->with('success', 'Задача обновлена');
    }
    
    public function destroy($id)
    {
        DeveloperTask::findOrFail($id)->delete();
        return back()->with('success', 'Задача удалена');
    }
}

