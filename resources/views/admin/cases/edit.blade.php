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
    
    @include('admin.cases.partials.sections', ['initialSections' => old('sections', $case->sections ?? [])])
    
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

