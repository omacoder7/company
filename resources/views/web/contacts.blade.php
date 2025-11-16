@extends('web.layouts.app')

@section('title', 'Контакты')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="section-title">{{ $content['title'] ?? 'Контакты' }}</h1>
        <p class="section-subtitle">{{ $content['subtitle'] ?? 'Свяжитесь с нами для обсуждения проекта' }}</p>
        
        <div style="max-width: 800px; margin: var(--spacing-xl) auto;">
            <div class="grid grid-2" style="margin-bottom: var(--spacing-xl);">
                <div class="card">
                    <h3>Email</h3>
                    <p class="card-text">
                        <a href="mailto:info@studio.com" style="color: var(--color-primary-light);">info@studio.com</a>
                    </p>
                </div>
                <div class="card">
                    <h3>Telegram</h3>
                    <p class="card-text">
                        <a href="https://t.me/studio" style="color: var(--color-primary-light);">@studio</a>
                    </p>
                </div>
            </div>
            
            @if(isset($content['work_format']) && $content['work_format'])
            <div style="margin-bottom: var(--spacing-xl);">
                <h2>Формат работы</h2>
                <p style="font-size: 1.1rem; line-height: 1.8;">{{ $content['work_format'] }}</p>
            </div>
            @endif
            
            <h2 class="text-center" style="margin-bottom: var(--spacing-md);">Форма связи</h2>
            <form action="{{ route('contacts.store') }}" method="POST" class="form" data-ajax>
                @csrf
                @if(session('success'))
                <div class="form-success">{{ session('success') }}</div>
                @endif
                
                <div class="form-group">
                    <label for="name" class="form-label">Имя *</label>
                    <input type="text" id="name" name="name" class="form-input" required>
                    @error('name')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="contact" class="form-label">Email или Telegram *</label>
                    <input type="text" id="contact" name="contact" class="form-input" required>
                    @error('contact')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">Сообщение</label>
                    <textarea id="message" name="message" class="form-textarea" placeholder="Опишите ваш проект или задачу..."></textarea>
                    @error('message')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Отправить</button>
            </form>
        </div>
    </div>
</section>
@endsection

