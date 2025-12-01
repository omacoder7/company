@extends('web.layouts.app')

@section('title', 'Для разработчиков')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="hero-title heading-imperial">{{ $content['title'] ?? __('pages.for_developers') }}</h1>
        <p class="hero-text">{{ $content['subtitle'] ?? __('pages.for_developers_description') }}</p>
        <div style="margin-top: var(--spacing-lg);">
            <div class="hourly-rate">
                <span class="hourly-rate-label">{{ __('pages.hourly_rate') }}</span>
                <span>{{ __('pages.rate') }}</span>
            </div>
        </div>
    </div>
</section>

<!-- Who We Are Looking For -->
<section class="section">
    <div class="container">
        <h2 class="section-title">{{ __('pages.who_we_are_looking') }}</h2>
        <div style="max-width: 800px; margin: 0 auto;">
            <p style="font-size: 1.125rem; line-height: 1.8; margin-bottom: var(--spacing-md); text-align: center;">
                {{ $content['who_text'] ?? __('pages.who_we_are_looking_description') }}
            </p>
        </div>
    </div>
</section>

<!-- Standards Section - For Developers -->
<section class="section" style="background-color: var(--color-premium-green-dark);">
    <div class="container">
        <h2 class="section-title heading-imperial">{{ __('pages.our_standarts') }}</h2>
        <p class="section-subtitle">{{ __('pages.our_standarts_description') }}</p>
        <div class="standards-grid">
            <div class="standard-card">
                <h4>{{ __('pages.deals') }}</h4>
                <p class="card-text">{{ __('pages.deals_description') }}</p>
            </div>
            <div class="standard-card">
                <h4>{{ __('pages.deadlines') }}</h4>
                <p class="card-text">{{ __('pages.deadlines_description') }}</p>
            </div>
            <div class="standard-card">
                <h4>{{ __('pages.reports') }}</h4>
                <p class="card-text">{{ __('pages.reports_description') }}</p>
            </div>
            <div class="standard-card">
                <h4>{{ __('pages.quality') }}</h4>
                <p class="card-text">{{ __('pages.quality_description') }}</p>
            </div>
            <div class="standard-card">
                <h4>{{ __('pages.nda') }}</h4>
                <p class="card-text">{{ __('pages.nda_description') }}</p>
            </div>
            <div class="standard-card">
                <h4>{{ __('pages.hard_work') }}</h4>
                <p class="card-text">{{ __('pages.hard_work_description') }}</p>
            </div>
            <div class="standard-card">
                <h4>{{ __('pages.client_orientation') }}</h4>
                <p class="card-text">{{ __('pages.client_orientation_description') }}</p>
            </div>
        </div>
        
        <div style="max-width: 800px; margin: var(--spacing-xl) auto 0; padding: var(--spacing-md); background-color: var(--color-gray-medium); border-radius: var(--border-radius); border-left: 4px solid var(--color-orange-energy);">
            <h3 class="heading-energy" style="margin-bottom: var(--spacing-sm);">{{ __('pages.internal_competition') }}</h3>
            <p class="card-text" style="margin-bottom: 0; line-height: 1.7;">
                {{ __('pages.internal_competition_description') }}
            </p>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section">
    <div class="container">
        <h2 class="section-title">{{ __('pages.how_the_work_is_organized') }}</h2>
        <div class="grid grid-2" style="max-width: 1000px; margin: 0 auto;">
            <div class="card">
                <h3>{{ __('pages.tasks') }}</h3>
                <p class="card-text">{{ __('pages.tasks_description') }}</p>
            </div>
            <div class="card">
                <h3>{{ __('pages.deadlines_2') }}</h3>
                <p class="card-text">{{ __('pages.deadlines_2_description') }}</p>
            </div>
            <div class="card">
                <h3>{{ __('pages.reports') }}</h3>
                <p class="card-text">{{ __('pages.reports_description') }}</p>
            </div>
            <div class="card">
                <h3>{{ __('pages.payment') }}</h3>
                <p class="card-text">{{ __('pages.payment_description_part1') }} <span class="money-emphasis">{{ __('pages.rate') }}</span>, {{ __('pages.payment_description_part2') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Open Tasks -->
@if($tasks->count() > 0)
<section class="section" style="background-color: var(--color-gray-dark);">
    <div class="container">
        <h2 class="section-title">{{ __('pages.open_tasks') }}</h2>
        <p class="section-subtitle">{{ __('pages.open_tasks_description') }}</p>
        <div class="grid grid-2">
            @foreach($tasks as $task)
            <div class="card" style="border-left: 4px solid var(--color-blue-science);">
                <h3 class="card-title">{{ $task->title }}</h3>
                @if($task->description)
                <p class="card-text">{{ $task->description }}</p>
                @endif
                <div style="margin-top: var(--spacing-sm);">
                    @if($task->stack)
                    <p class="card-text" style="margin-bottom: var(--spacing-xs);">
                        <strong class="science-accent">Stack:</strong> {{ $task->stack }}
                    </p>
                    @endif
                    @if($task->format)
                    <p class="card-text" style="margin-bottom: 0;">
                        <strong>Format:</strong> {{ $task->format }}
                    </p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Application Form -->
<section class="section" style="background-color: var(--color-premium-green-dark);">
    <div class="container">
        <div style="max-width: 700px; margin: 0 auto;">
            <h2 class="section-title heading-imperial">{{ __('pages.response_form') }}</h2>
            <p class="section-subtitle">{{ __('pages.response_form_description') }}</p>
            <form action="{{ route('developers.apply', ['locale' => app()->getLocale()]) }}" method="POST" class="form" data-ajax>
                @csrf
                @if(session('success'))
                <div class="form-success">{{ session('success') }}</div>
                @endif
                
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('pages.name') }} *</label>
                    <input type="text" id="name" name="name" class="form-input" required>
                    @error('name')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="contact" class="form-label">Email или Telegram *</label>
                    <input type="text" id="contact" name="contact" class="form-input" required placeholder="email@example.com или @telegram">
                    @error('contact')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="stack" class="form-label">{{ __('pages.stack') }}</label>
                    <input type="text" id="stack" name="stack" class="form-input" placeholder="PHP, Laravel, Vue.js, React, Node.js...">
                    @error('stack')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="github" class="form-label">GitHub</label>
                    <input type="url" id="github" name="github" class="form-input" placeholder="https://github.com/username">
                    @error('github')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="portfolio" class="form-label">{{ __('pages.portfolio') }}</label>
                    <input type="url" id="portfolio" name="portfolio" class="form-input" placeholder="https://example.com">
                    @error('portfolio')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">{{ __('pages.message') }}</label>
                    <textarea id="message" name="message" class="form-textarea" placeholder={{ __('pages.message_body') }}></textarea>
                    @error('message')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-imperial" style="width: 100%;">{{ __('pages.send_application') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection
