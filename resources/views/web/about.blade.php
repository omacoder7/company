@extends('web.layouts.app')

@section('title', 'О компании')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="section-title">{{ $content['title'] ?? 'О компании' }}</h1>
        <div style="max-width: 800px; margin: 0 auto;">
            <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: var(--spacing-md);">
                {{ $content['description'] ?? 'Мы — команда профессионалов, специализирующаяся на разработке качественных решений. Наш подход основан на строгих стандартах, дисциплине и фокусе на результате.' }}
            </p>
            
            <h2 style="margin-top: var(--spacing-xl); margin-bottom: var(--spacing-md);">{{ __('pages.basic_principles') }}</h2>
            <div class="grid grid-2" style="margin-top: var(--spacing-md);">
                <div class="card">
                    <h3>{{ __('pages.code_quality') }}</h3>
                    <p class="card-text">{{ $content['principle_1'] ?? __('pages.code_quality_description') }}</p>
                </div>
                <div class="card">
                    <h3>{{ __('pages.meeting_deadlines') }}</h3>
                    <p class="card-text">{{ $content['principle_2'] ?? __('pages.meeting_deadlines_descriptions') }}</p>
                </div>
                <div class="card">
                    <h3>{{ __('pages.professionalism') }}</h3>
                    <p class="card-text">{{ $content['principle_3'] ?? __('pages.professionalism_description') }}</p>
                </div>
                <div class="card">
                    <h3>{{ __('pages.Confidentiality') }}</h3>
                    <p class="card-text">{{ $content['principle_4'] ?? __('pages.confidentiality_description') }}</p>
                </div>
            </div>
            
            @if(isset($content['clients_title']) && $content['clients_title'])
            <h2 style="margin-top: var(--spacing-xl); margin-bottom: var(--spacing-md);">{{ $content['clients_title'] }}</h2>
            <p class="card-text">{{ $content['clients_text'] ?? '' }}</p>
            @endif
        </div>
    </div>
</section>
@endsection

