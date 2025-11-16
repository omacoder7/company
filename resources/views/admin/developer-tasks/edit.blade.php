@extends('admin.layouts.layout')

@section('title', 'Редактировать задачу')

@section('content')
<div class="admin-header">
    <h1>Редактировать задачу</h1>
    <a href="{{ route('admin.developer-tasks.index') }}" class="btn btn-secondary">Назад</a>
</div>

<form action="{{ route('admin.developer-tasks.update', $task->id) }}" method="POST" style="max-width: 800px;">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label class="form-label">Название *</label>
        <input type="text" name="title" class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title', $task->title) }}" required>
        @error('title')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-textarea {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $task->description) }}</textarea>
        @error('description')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Стек</label>
        <input type="text" name="stack" class="form-input {{ $errors->has('stack') ? 'is-invalid' : '' }}" value="{{ old('stack', $task->stack) }}" placeholder="PHP, Laravel, Vue.js...">
        @error('stack')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Формат</label>
        <input type="text" name="format" class="form-input {{ $errors->has('format') ? 'is-invalid' : '' }}" value="{{ old('format', $task->format) }}" placeholder="Удаленно, полный день...">
        @error('format')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Порядок</label>
        <input type="number" name="order" class="form-input {{ $errors->has('order') ? 'is-invalid' : '' }}" value="{{ old('order', $task->order) }}" min="1">
        @error('order')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label style="display: flex; align-items: center; gap: var(--spacing-xs);">
            <input type="checkbox" name="is_active" value="1" {{ $task->is_active ? 'checked' : '' }}>
            <span>Активна</span>
        </label>
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection

