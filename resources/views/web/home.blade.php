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
            <a href="{{ route('contacts') }}" class="btn btn-imperial">Обсудить проект</a>
            <a href="{{ route('cases') }}" class="btn btn-secondary">Посмотреть кейсы</a>
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
                <h3 class="heading-science">Архитектура</h3>
                <p class="card-text">Проектируем масштабируемые системы с учётом будущего роста и нагрузки.</p>
            </div>
            <div class="card science-bg">
                <h3 class="heading-science">R&D</h3>
                <p class="card-text">Исследования, эксперименты, внедрение передовых технологий в каждый проект.</p>
            </div>
            <div class="card science-bg">
                <h3 class="heading-science">Аналитика</h3>
                <p class="card-text">Данные, метрики, расчёты. Каждое решение основано на анализе и логике.</p>
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
                <h3 class="heading-imperial">Для бизнеса</h3>
                <p class="card-text">Каждая система, которую мы создаём, нацелена на увеличение прибыли клиента. Мы не делаем «просто сайты» — мы строим денежные машины.</p>
            </div>
            <div class="card" style="border-left: 4px solid var(--color-red-imperial);">
                <h3 class="heading-imperial">Для нас</h3>
                <p class="card-text">Это наш самый прибыльный проект. Мы вкладываем в него максимум ресурсов, потому что понимаем ценность результата.</p>
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
                <h3>Стартапы и малый бизнес</h3>
                <p class="card-text">Технологии и скорость — ваше преимущество. Мы даём инструменты, которые позволяют конкурировать с крупными игроками.</p>
            </div>
            <div class="card">
                <h3>Крупные компании</h3>
                <p class="card-text">Дисциплина, качество, масштабируемость. Мы строим системы, которые выдерживают нагрузку и растут вместе с бизнесом.</p>
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
                <a href="{{ route('services') }}" class="btn">Подробнее</a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('services') }}" class="btn btn-imperial">Все услуги</a>
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
                <a href="{{ route('cases.show', $case->id) }}" class="btn">Подробнее</a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('cases') }}" class="btn btn-imperial">Все кейсы</a>
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
                <h4>Сделки</h4>
                <p class="card-text">Честные условия, прозрачные договорённости, выполнение обязательств</p>
            </div>
            <div class="standard-card">
                <h4>Сроки</h4>
                <p class="card-text">Четкие дедлайны и соблюдение сроков. Никаких оправданий</p>
            </div>
            <div class="standard-card">
                <h4>Отчёты</h4>
                <p class="card-text">Регулярные отчёты о прогрессе. Прозрачность на каждом этапе</p>
            </div>
            <div class="standard-card">
                <h4>Качество</h4>
                <p class="card-text">Код-ревью и тестирование на каждом этапе. Ноль компромиссов</p>
            </div>
            <div class="standard-card">
                <h4>NDA</h4>
                <p class="card-text">Строгое соблюдение конфиденциальности по всем проектам</p>
            </div>
            <div class="standard-card">
                <h4>Трудолюбие</h4>
                <p class="card-text">Работа на результат. Максимальная отдача в каждом проекте</p>
            </div>
            <div class="standard-card">
                <h4>Клиентоориентированность</h4>
                <p class="card-text">Фокус на бизнес-целях клиента. Результат превыше всего</p>
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
                <span class="hourly-rate-label">Наша ставка</span>
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
            <a href="{{ route('developers') }}" class="btn btn-imperial">Узнать больше</a>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="section" style="background-color: var(--color-premium-green-dark);">
    <div class="container">
        <h2 class="section-title heading-imperial">{{ $content['contact_title'] ?? 'Обсудить проект' }}</h2>
        <p class="section-subtitle">{{ $content['contact_subtitle'] ?? 'Готовы начать? Расскажите о вашем проекте, и мы обсудим, как технологии помогут вам зарабатывать больше.' }}</p>
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
                <textarea id="message" name="message" class="form-textarea" placeholder="Расскажите о вашем проекте, целях, сроках..."></textarea>
                @error('message')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-imperial" style="width: 100%;">Отправить</button>
        </form>
    </div>
</section>
@endsection
