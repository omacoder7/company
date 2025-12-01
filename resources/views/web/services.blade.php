@extends('web.layouts.app')

@section('title', 'Услуги')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="section-title">{{ __('pages.services') }}</h1>
        <p class="section-subtitle">{{ __('pages.services_description') }}</p>
        
        @if($services->count() > 0)
        <div class="grid grid-2" style="margin-top: var(--spacing-xl);">
            @foreach($services as $service)
            <div class="card">
                <h2 class="card-title">{{ $service->title }}</h2>
                @if($service->description)
                <p class="card-text">{{ $service->description }}</p>
                @endif
                
                @if($service->problem)
                <div style="margin-top: var(--spacing-md);">
                    <h4 style="color: var(--color-text-light); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: var(--spacing-xs);">{{ __('pages.problem') }}</h4>
                    <p class="card-text">{{ $service->problem }}</p>
                </div>
                @endif
                
                @if($service->solution)
                <div style="margin-top: var(--spacing-md);">
                    <h4 style="color: var(--color-text-light); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: var(--spacing-xs);">{{ __('pages.solution') }}</h4>
                    <p class="card-text">{{ $service->solution }}</p>
                </div>
                @endif
                
                @if($service->result)
                <div style="margin-top: var(--spacing-md);">
                    <h4 style="color: var(--color-text-light); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: var(--spacing-xs);">{{ __('pages.result') }}</h4>
                    <p class="card-text">{{ $service->result }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center" style="padding: var(--spacing-xl);">
            <p>{{ __('pages.not_added') }}</p>
        </div>
        @endif
        
        <div class="text-center mt-3">
            <a href="{{ route('contacts', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">{{ __('pages.discuss_project') }}</a>
        </div>
    </div>
</section>
@endsection

