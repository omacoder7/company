@extends('admin.layouts.layout')

@section('title', 'Редактировать кейс')

@section('content')
<div class="admin-header">
    <h1>Редактировать кейс</h1>
    <a href="{{ route('admin.cases.index') }}" class="btn btn-secondary">Назад</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: var(--spacing-md); border-radius: var(--border-radius); margin-bottom: var(--spacing-lg);">
        <h4 style="margin-top: 0;">Ошибки валидации:</h4>
        <ul style="margin-bottom: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.cases.update', $case->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 1200px;">
    @csrf
    @method('PUT')
    
    <!-- Language Tabs -->
    <div class="language-tabs" style="margin-bottom: var(--spacing-lg); border-bottom: 2px solid var(--color-border);">
        <button type="button" class="lang-tab active" data-lang="ru" onclick="switchLanguage('ru')">🇷🇺 Русский</button>
        <button type="button" class="lang-tab" data-lang="en" onclick="switchLanguage('en')">🇬🇧 English</button>
        <button type="button" class="lang-tab" data-lang="az" onclick="switchLanguage('az')">🇦🇿 Azərbaycan</button>
    </div>
    
    @foreach(['ru', 'en', 'az'] as $locale)
    @php
        $translation = $translations[$locale] ?? ['title' => '', 'sections' => []];
    @endphp
    <div class="language-content" id="lang-{{ $locale }}" style="display: {{ $locale === 'ru' ? 'block' : 'none' }};">
        <h2 style="margin-bottom: var(--spacing-md); color: var(--color-primary);">
            @if($locale === 'ru') Русский
            @elseif($locale === 'en') English
            @else Azərbaycan
            @endif
        </h2>
        
        <div class="form-group">
            <label class="form-label">Название *</label>
            <input
                type="text"
                name="translations[{{ $locale }}][title]"
                class="form-input"
                value="{{ old("translations.$locale.title", $translation['title']) }}"
            >
            @error("translations.$locale.title")
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        @include('admin.cases.partials.sections', [
            'initialSections' => old("translations.$locale.sections", $translation['sections'] ?? []),
            'locale' => $locale,
            'prefix' => "translations[$locale][sections]"
        ])
    </div>
    @endforeach
    
    <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-lg); border-top: 2px solid var(--color-border);">
        @if($case->image)
        <div class="form-group">
            <label class="form-label">Текущее изображение</label>
            <img src="{{ asset('storage/' . $case->image) }}" alt="{{ $case->title }}" style="max-width: 300px; border-radius: var(--border-radius);">
        </div>
        @endif
        
        <div class="form-group">
            <label class="form-label">Новое изображение</label>
            <input type="file" name="image" class="form-input" accept="image/*">
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="form-label">Порядок</label>
            <input type="number" name="order" class="form-input" value="{{ old('order', $case->order) }}" min="1">
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
    </div>
</form>

<style>
.language-tabs {
    display: flex;
    gap: var(--spacing-xs);
    margin-bottom: var(--spacing-md);
}
.lang-tab {
    padding: var(--spacing-sm) var(--spacing-md);
    background-color: var(--color-gray-light);
    border: 1px solid var(--color-border);
    border-bottom: none;
    border-radius: var(--border-radius) var(--border-radius) 0 0;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s;
}
.lang-tab:hover {
    background-color: var(--color-gray);
}
.lang-tab.active {
    background-color: var(--color-primary);
    color: white;
    border-color: var(--color-primary);
}
.language-content {
    padding: var(--spacing-lg);
    background-color: var(--color-gray-light);
    border-radius: var(--border-radius);
    margin-bottom: var(--spacing-md);
}
</style>

<script>
function switchLanguage(lang) {
    document.querySelectorAll('.language-content').forEach(content => {
        content.style.display = 'none';
    });
    document.querySelectorAll('.lang-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.getElementById('lang-' + lang).style.display = 'block';
    document.querySelector(`.lang-tab[data-lang="${lang}"]`).classList.add('active');
}
</script>
@endsection
