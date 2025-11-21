@extends('admin.layouts.layout')

@section('title', 'Создать кейс')

@section('content')
<div class="admin-header">
    <h1>Создать кейс</h1>
    <a href="{{ route('admin.cases.index') }}" class="btn btn-secondary">Назад</a>
</div>

<form action="{{ route('admin.cases.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 800px;">
    @csrf
    
    <div class="form-group">
        <label class="form-label">Название *</label>
        <input type="text" name="title" class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}" required>
        @error('title')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    @include('admin.cases.partials.sections', ['initialSections' => old('sections', [])])
    
    <div class="form-group">
        <label class="form-label">Изображение</label>
        <input type="file" name="image" class="form-input {{ $errors->has('image') ? 'is-invalid' : '' }}" accept="image/*">
        @error('image')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Порядок</label>
        <input type="number" name="order" class="form-input {{ $errors->has('order') ? 'is-invalid' : '' }}" value="{{ old('order', 1) }}" min="1">
        @error('order')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label style="display: flex; align-items: center; gap: var(--spacing-xs);">
            <input type="checkbox" name="is_active" value="1" checked>
            <span>Активен</span>
        </label>
    </div>
    
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
@endsection

