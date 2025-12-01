@extends('web.layouts.app')

@section('title', 'Главная')

@section('content')
<!-- Hero Section - Imperial, Powerful, Technology -->
<section class="hero">
    <div class="container">
        <div class="speed-indicator" style="margin-bottom: var(--spacing-md);">{{ $content['hero_speed_indicator'] ?? 'Скорость исполнения' }}</div>
        <h1 class="hero-title heading-imperial">{{ $content['hero_title'] ?? 'Технологии. Дисциплина. Результат.' }}</h1>
        <p class="hero-text">{{ $content['hero_text'] ?? 'Мы меняем мир с помощью технологий. Создаём системы, которые помогают зарабатывать максимально много — для клиентов и для нас.' }}</p>
        <div class="hero-actions">
            <a href="{{ route('contacts', ['locale' => app()->getLocale()]) }}" class="btn btn-imperial">{{ __('pages.discuss_project') }}</a>
            <a href="{{ route('cases', ['locale' => app()->getLocale()]) }}" class="btn btn-secondary">{{ __('pages.view_cases') }}</a>
        </div>
    </div>
</section>

<!-- Technology Company Section - Science Blue Accent -->
<section class="section">
    <div class="container">
        <h2 class="section-title heading-science">{{ $content['technology_company_title'] ?? 'Технологическая компания' }}</h2>
        <p class="section-subtitle">{{ $content['technology_company_subtitle'] ?? 'Мы не просто агентство. Мы создаём архитектуры, системы и решения, которые меняют правила игры.' }}</p>
        <div class="grid grid-3">
            <div class="card science-bg">
                <h3 class="heading-science">{{ __('pages.architecture') }}</h3>
                <p class="card-text">{{ __('pages.architecture_description') }}</p>
            </div>
            <div class="card science-bg">
                <h3 class="heading-science">R&D</h3>
                <p class="card-text">{{ __('pages.r&d_description') }}</p>
            </div>
            <div class="card science-bg">
                <h3 class="heading-science">{{ __('pages.analytics') }}</h3>
                <p class="card-text">{{ __('pages.analytics_description') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Profit/Money Section - Red Imperial Accent -->
<section class="section" style="background-color: var(--color-premium-green-dark);">
    <div class="container">
        <h2 class="section-title heading-imperial">{{ $content['profit_systems_title'] ?? 'Системы, которые зарабатывают' }}</h2>
        <p class="section-subtitle">{{ $content['profit_systems_subtitle'] ?? 'Мы делаем проекты, которые приносят максимальную прибыль. Для клиентов. Для нас. Это наш внутренний ориентир.' }}</p>
        <div class="grid grid-2" style="max-width: 900px; margin: 0 auto;">
            <div class="card" style="border-left: 4px solid var(--color-red-imperial);">
                <h3 class="heading-imperial">{{ __('pages.for_business') }}</h3>
                <p class="card-text">{{ __('pages.for_business_description') }}</p>
            </div>
            <div class="card" style="border-left: 4px solid var(--color-red-imperial);">
                <h3 class="heading-imperial">{{ __('pages.for_us') }}</h3>
                <p class="card-text">{{ __('pages.for_us_description') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Against Goliath Section - Energy Orange Accent -->
<section class="section">
    <div class="container">
        <h2 class="section-title heading-energy">{{ $content['against_goliath_title'] ?? 'Против Голиафа' }}</h2>
        <p class="section-subtitle">{{ $content['against_goliath_subtitle'] ?? 'Мы помогаем и маленьким, и крупным компаниям выигрывать за счёт технологий, дисциплины и стратегии.' }}</p>
        <div class="grid grid-2">
            <div class="card">
                <h3>{{ __('pages.startup') }}</h3>
                <p class="card-text">{{ __('pages.startup_description') }}</p>
            </div>
            <div class="card">
                <h3>{{ __('pages.big_company') }}</h3>
                <p class="card-text">{{ __('pages.big_company_description') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
@if($services->count() > 0)
<section class="section" style="background-color: var(--color-gray-dark);">
    <div class="container">
        <h2 class="section-title">{{ $content['services_title'] ?? 'Услуги' }}</h2>
        <p class="section-subtitle">{{ $content['services_subtitle'] ?? 'Направления нашей работы' }}</p>
        <div class="grid grid-3">
            @foreach($services as $service)
            <div class="card">
                <h3 class="card-title">{{ $service->title }}</h3>
                <p class="card-text">{{ $service->description }}</p>
                <a href="{{ route('services', ['locale' => app()->getLocale()]) }}" class="btn">{{ __('pages.more_details') }}</a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('services', ['locale' => app()->getLocale()]) }}" class="btn btn-imperial">{{ __('pages.all_services') }}</a>
        </div>
    </div>
</section>
@endif

<!-- Cases Section -->
@if($cases->count() > 0)
<section class="section">
    <div class="container">
        <h2 class="section-title">{{ $content['cases_title'] ?? 'Кейсы' }}</h2>
        <p class="section-subtitle">{{ $content['cases_subtitle'] ?? 'Реализованные проекты, которые приносят результат' }}</p>
        <div class="grid grid-3">
            @foreach($cases as $case)
            <div class="card">
                @if($case->image)
                <img src="{{ asset('storage/' . $case->image) }}" alt="{{ $case->title }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: var(--spacing-sm);">
                @endif
                <h3 class="card-title">{{ $case->title }}</h3>
                @php
                    $primaryDetails = collect($case->primary_details ?? [])->take(2);
                @endphp
                @if($primaryDetails->isNotEmpty())
                    @foreach($primaryDetails as $detail)
                        <p class="card-text">
                            @if(!empty($detail['label']))
                                <strong>{{ $detail['label'] }}:</strong>
                            @endif
                            {{ strip_tags($detail['value'] ?? '') }}
                        </p>
                    @endforeach
                @endif
                @if($case->summary)
                <p class="card-text">{{ Str::limit($case->summary, 150) }}</p>
                @endif
                <a href="{{ route('cases.show', ['locale' => app()->getLocale(), 'id' => $case->id]) }}" class="btn">{{ __('pages.more_details') }}</a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('cases', ['locale' => app()->getLocale()]) }}" class="btn btn-imperial">{{ __('pages.all_cases') }}</a>
        </div>
    </div>
</section>
@endif

<!-- Standards Section - All 7 Standards -->
<section class="section" style="background-color: var(--color-premium-green-dark);">
    <div class="container">
        <h2 class="section-title heading-imperial">{{ $content['standards_title'] ?? 'Наши стандарты' }}</h2>
        <p class="section-subtitle">{{ $content['standards_subtitle'] ?? 'Это не просто слова. Это обязательные требования к каждому проекту и каждому члену команды.' }}</p>
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
    </div>
</section>

<!-- Hourly Rate Section -->
<section class="section">
    <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto;">
            <h2 class="section-title">{{ $content['hourly_rate_title'] ?? 'Почасовая ставка' }}</h2>
            <div class="hourly-rate">
                <span class="hourly-rate-label">{{ __('pages.our_rate') }}</span>
                <span>{{ $content['hourly_rate_amount'] ?? '$50 / час' }}</span>
            </div>
            <p class="section-subtitle" style="margin-top: var(--spacing-md);">
                {{ $content['hourly_rate_subtitle'] ?? 'Без лишних пояснений. Деловой и уверенный подход к ценообразованию.' }}
            </p>
        </div>
    </div>
</section>

<!-- Developers Teaser -->
<section class="section" style="background-color: var(--color-gray-dark);">
    <div class="container">
        <div class="card" style="text-align: center; padding: var(--spacing-xl); max-width: 800px; margin: 0 auto;">
            <h2>{{ $content['developers_title'] ?? 'Для разработчиков' }}</h2>
            <p class="card-text" style="max-width: 600px; margin: 0 auto var(--spacing-md); font-size: 1.125rem;">
                {{ $content['developers_text'] ?? 'Ищем талантливых разработчиков для работы над интересными проектами. Строгие стандарты, качественный код, справедливая оплата.' }}
            </p>
            <div style="margin: var(--spacing-md) 0;">
                <span class="hourly-rate" style="font-size: 1.25rem; padding: var(--spacing-xs) var(--spacing-md);">
                    {{ $content['developers_rate'] ?? '$50 / час' }}
                </span>
            </div>
            <a href="{{ route('developers', ['locale' => app()->getLocale()]) }}" class="btn btn-imperial">{{ __('pages.learn_more') }}</a>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="section" style="background-color: var(--color-premium-green-dark);">
    <div class="container">
        <h2 class="section-title heading-imperial">{{ $content['contact_title'] ?? 'Обсудить проект' }}</h2>
        <p class="section-subtitle">{{ $content['contact_subtitle'] ?? 'Готовы начать? Расскажите о вашем проекте, и мы обсудим, как технологии помогут вам зарабатывать больше.' }}</p>
        <form action="{{ route('contacts.store', ['locale' => app()->getLocale()]) }}" method="POST" class="form" data-ajax>
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
                <input type="text" id="contact" name="contact" class="form-input" required>
                @error('contact')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="message" class="form-label">{{ __('pages.message') }}</label>
                <textarea id="message" name="message" class="form-textarea" placeholder="{{ __('pages.message_body') }}"></textarea>
                @error('message')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-imperial" style="width: 100%;">{{ __('pages.send') }}</button>
        </form>
    </div>
</section>
@endsection
