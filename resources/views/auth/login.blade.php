@extends('web.layouts.app')

@section('title', 'Вход в админку')

@section('content')
<section class="section">
    <div class="container">
        <div style="max-width: 400px; margin: var(--spacing-xl) auto;">
            <h1 class="section-title" style="text-align: center; margin-bottom: var(--spacing-md);">Вход в админку</h1>
            
            <form action="{{ route('login') }}" method="POST" class="form">
                @csrf
                
                @if($errors->any())
                <div class="form-error" style="margin-bottom: var(--spacing-md);">
                    {{ $errors->first() }}
                </div>
                @endif
                
                <div class="form-group">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Пароль *</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                    @error('password')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: var(--spacing-xs);">
                        <input type="checkbox" name="remember" value="1">
                        <span>Запомнить меня</span>
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Войти</button>
            </form>
        </div>
    </div>
</section>
@endsection

