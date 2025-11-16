@extends('admin.layouts.layout')

@section('title', 'Редактировать кейс')

@section('content')
<div class="admin-header">
    <h1>Редактировать кейс</h1>
    <a href="{{ route('admin.cases.index') }}" class="btn btn-secondary">Назад</a>
</div>

<form action="{{ route('admin.cases.update', $case->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 800px;">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label class="form-label">Название *</label>
        <input type="text" name="title" class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title', $case->title) }}" required>
        @error('title')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Клиент</label>
        <input type="text" name="client" class="form-input {{ $errors->has('client') ? 'is-invalid' : '' }}" value="{{ old('client', $case->client) }}">
        @error('client')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Ниша</label>
        <input type="text" name="niche" class="form-input {{ $errors->has('niche') ? 'is-invalid' : '' }}" value="{{ old('niche', $case->niche) }}">
        @error('niche')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Задача</label>
        <textarea name="task" class="form-textarea {{ $errors->has('task') ? 'is-invalid' : '' }}">{{ old('task', $case->task) }}</textarea>
        @error('task')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Решение</label>
        <textarea name="solution" class="form-textarea {{ $errors->has('solution') ? 'is-invalid' : '' }}">{{ old('solution', $case->solution) }}</textarea>
        @error('solution')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Результат</label>
        <textarea name="result" class="form-textarea {{ $errors->has('result') ? 'is-invalid' : '' }}">{{ old('result', $case->result) }}</textarea>
        @error('result')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    @if($case->image)
    <div class="form-group">
        <label class="form-label">Текущее изображение</label>
        <img src="{{ asset('storage/' . $case->image) }}" alt="{{ $case->title }}" style="max-width: 300px; border-radius: var(--border-radius);">
    </div>
    @endif
    
    <div class="form-group">
        <label class="form-label">Новое изображение</label>
        <input type="file" name="image" class="form-input {{ $errors->has('image') ? 'is-invalid' : '' }}" accept="image/*">
        @error('image')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Порядок</label>
        <input type="number" name="order" class="form-input {{ $errors->has('order') ? 'is-invalid' : '' }}" value="{{ old('order', $case->order) }}" min="1">
        @error('order')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label style="display: flex; align-items: center; gap: var(--spacing-xs);">
            <input type="checkbox" name="is_active" value="1" {{ $case->is_active ? 'checked' : '' }}>
            <span>Активен</span>
        </label>
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection

