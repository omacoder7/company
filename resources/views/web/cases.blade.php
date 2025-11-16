@extends('web.layouts.app')

@section('title', 'Кейсы')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="section-title">Кейсы</h1>
        <p class="section-subtitle">Реализованные проекты</p>
        
        @if($cases->count() > 0)
        <div class="grid grid-3" style="margin-top: var(--spacing-xl);">
            @foreach($cases as $case)
            <div class="card">
                @if($case->image)
                <img src="{{ asset('storage/' . $case->image) }}" alt="{{ $case->title }}" style="width: 100%; height: 250px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: var(--spacing-sm);">
                @endif
                <h3 class="card-title">{{ $case->title }}</h3>
                @if($case->client)
                <p class="card-text"><strong>Клиент:</strong> {{ $case->client }}</p>
                @endif
                @if($case->niche)
                <p class="card-text"><strong>Ниша:</strong> {{ $case->niche }}</p>
                @endif
                @if($case->task)
                <p class="card-text">{{ Str::limit($case->task, 150) }}</p>
                @endif
                <a href="{{ route('cases.show', $case->id) }}" class="btn">Подробнее</a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center" style="padding: var(--spacing-xl);">
            <p>Кейсы пока не добавлены.</p>
        </div>
        @endif
    </div>
</section>
@endsection

