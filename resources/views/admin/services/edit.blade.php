@extends('admin.layouts.layout')

@section('title', 'Редактировать услугу')

@section('content')
<div class="admin-header">
    <h1>Редактировать услугу</h1>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Назад</a>
</div>

<form action="{{ route('admin.services.update', $service->id) }}" method="POST" style="max-width: 800px;">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label class="form-label">Название *</label>
        <input type="text" name="title" class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title', $service->title) }}" required>
        @error('title')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-textarea {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $service->description) }}</textarea>
        @error('description')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Проблема</label>
        <textarea name="problem" class="form-textarea {{ $errors->has('problem') ? 'is-invalid' : '' }}">{{ old('problem', $service->problem) }}</textarea>
        @error('problem')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Решение</label>
        <textarea name="solution" class="form-textarea {{ $errors->has('solution') ? 'is-invalid' : '' }}">{{ old('solution', $service->solution) }}</textarea>
        @error('solution')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Результат</label>
        <textarea name="result" class="form-textarea {{ $errors->has('result') ? 'is-invalid' : '' }}">{{ old('result', $service->result) }}</textarea>
        @error('result')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Порядок</label>
        <input type="number" name="order" class="form-input {{ $errors->has('order') ? 'is-invalid' : '' }}" value="{{ old('order', $service->order) }}" min="1">
        @error('order')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label style="display: flex; align-items: center; gap: var(--spacing-xs);">
            <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}>
            <span>Активна</span>
        </label>
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection

