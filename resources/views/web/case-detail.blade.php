@extends('web.layouts.app')

@section('title', $case->title)

@section('content')
<section class="section">
    <div class="container" style="max-width: 900px;">
        <a href="{{ route('cases') }}" class="btn btn-secondary" style="margin-bottom: var(--spacing-md);">← Назад к кейсам</a>
        
        @if($case->image)
        <img src="{{ asset('storage/' . $case->image) }}" alt="{{ $case->title }}" style="width: 100%; height: 400px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: var(--spacing-lg);">
        @endif
        
        <h1>{{ $case->title }}</h1>
        
        @if($case->client || $case->niche)
        <div style="display: flex; gap: var(--spacing-md); margin-bottom: var(--spacing-lg); flex-wrap: wrap;">
            @if($case->client)
            <div>
                <strong>Клиент:</strong> {{ $case->client }}
            </div>
            @endif
            @if($case->niche)
            <div>
                <strong>Ниша:</strong> {{ $case->niche }}
            </div>
            @endif
        </div>
        @endif
        
        @if($case->task)
        <div style="margin-bottom: var(--spacing-lg);">
            <h2>Задача</h2>
            <p style="font-size: 1.1rem; line-height: 1.8;">{{ $case->task }}</p>
        </div>
        @endif
        
        @if($case->solution)
        <div style="margin-bottom: var(--spacing-lg);">
            <h2>Решение</h2>
            <p style="font-size: 1.1rem; line-height: 1.8;">{{ $case->solution }}</p>
        </div>
        @endif
        
        @if($case->result)
        <div style="margin-bottom: var(--spacing-lg);">
            <h2>Результат</h2>
            <p style="font-size: 1.1rem; line-height: 1.8;">{{ $case->result }}</p>
        </div>
        @endif
        
        <div class="text-center mt-3">
            <a href="{{ route('contacts') }}" class="btn btn-primary">Обсудить проект</a>
        </div>
    </div>
</section>
@endsection

