@extends('web.layouts.app')

@section('title', 'Для разработчиков')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="hero-title heading-imperial">{{ $content['title'] ?? 'Для разработчиков' }}</h1>
        <p class="hero-text">{{ $content['subtitle'] ?? 'Присоединяйтесь к команде профессионалов. Работайте над проектами, которые приносят результат.' }}</p>
        <div style="margin-top: var(--spacing-lg);">
            <div class="hourly-rate">
                <span class="hourly-rate-label">Почасовая ставка</span>
                <span>$50 / час</span>
            </div>
        </div>
    </div>
</section>

<!-- Who We Are Looking For -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Кого мы ищем</h2>
        <div style="max-width: 800px; margin: 0 auto;">
            <p style="font-size: 1.125rem; line-height: 1.8; margin-bottom: var(--spacing-md); text-align: center;">
                {{ $content['who_text'] ?? 'Мы ищем талантливых разработчиков, которые ценят качество кода, соблюдение дедлайнов и профессиональный подход к работе. Людей, которые понимают, что результат важнее процесса.' }}
            </p>
        </div>
    </div>
</section>

<!-- Standards Section - For Developers -->
<section class="section" style="background-color: var(--color-premium-green-dark);">
    <div class="container">
        <h2 class="section-title heading-imperial">Наши стандарты</h2>
        <p class="section-subtitle">Это обязательные требования. Чем лучше вы их выполняете, тем выше ваш рейтинг, качественнее проекты, выше ставка и бонусы.</p>
        <div class="standards-grid">
            <div class="standard-card">
                <h4>Сделки</h4>
                <p class="card-text">Честные условия, выполнение обязательств, прозрачная коммуникация</p>
            </div>
            <div class="standard-card">
                <h4>Сроки</h4>
                <p class="card-text">Соблюдение дедлайнов. Реалистичная оценка времени. Никаких оправданий</p>
            </div>
            <div class="standard-card">
                <h4>Отчёты</h4>
                <p class="card-text">Регулярные отчёты о прогрессе. Прозрачность работы на каждом этапе</p>
            </div>
            <div class="standard-card">
                <h4>Качество</h4>
                <p class="card-text">Код-ревью, тестирование, следование стандартам. Ноль компромиссов</p>
            </div>
            <div class="standard-card">
                <h4>NDA</h4>
                <p class="card-text">Строгое соблюдение конфиденциальности по всем проектам без исключений</p>
            </div>
            <div class="standard-card">
                <h4>Трудолюбие</h4>
                <p class="card-text">Работа на результат. Максимальная отдача. Внутренняя мотивация</p>
            </div>
            <div class="standard-card">
                <h4>Клиентоориентированность</h4>
                <p class="card-text">Фокус на бизнес-целях клиента. Понимание контекста и задач</p>
            </div>
        </div>
        
        <div style="max-width: 800px; margin: var(--spacing-xl) auto 0; padding: var(--spacing-md); background-color: var(--color-gray-medium); border-radius: var(--border-radius); border-left: 4px solid var(--color-orange-energy);">
            <h3 class="heading-energy" style="margin-bottom: var(--spacing-sm);">Внутренняя конкуренция</h3>
            <p class="card-text" style="margin-bottom: 0; line-height: 1.7;">
                У нас действует система внутренней конкуренции. Чем лучше вы выполняете задачи по стандартам, тем выше ваш рейтинг. 
                Высокий рейтинг означает доступ к более интересным и прибыльным проектам, возможность повышения ставки и получения бонусов. 
                Это справедливо и мотивирует работать на максимум.
            </p>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Как устроена работа</h2>
        <div class="grid grid-2" style="max-width: 1000px; margin: 0 auto;">
            <div class="card">
                <h3>Задачи</h3>
                <p class="card-text">Четко поставленные задачи с техническим заданием. Понятные требования и критерии приёмки.</p>
            </div>
            <div class="card">
                <h3>Дедлайны</h3>
                <p class="card-text">Реалистичные сроки выполнения с возможностью обсуждения. Но после согласования — строгое соблюдение.</p>
            </div>
            <div class="card">
                <h3>Отчёты</h3>
                <p class="card-text">Регулярные отчёты о прогрессе работы. Прозрачность и коммуникация на каждом этапе.</p>
            </div>
            <div class="card">
                <h3>Оплата</h3>
                <p class="card-text">Справедливая оплата <span class="money-emphasis">$50/час</span>, прозрачные условия, своевременные выплаты.</p>
            </div>
        </div>
    </div>
</section>

<!-- Open Tasks -->
@if($tasks->count() > 0)
<section class="section" style="background-color: var(--color-gray-dark);">
    <div class="container">
        <h2 class="section-title">Открытые задачи</h2>
        <p class="section-subtitle">Актуальные проекты, для которых мы ищем исполнителей</p>
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
                        <strong class="science-accent">Стек:</strong> {{ $task->stack }}
                    </p>
                    @endif
                    @if($task->format)
                    <p class="card-text" style="margin-bottom: 0;">
                        <strong>Формат:</strong> {{ $task->format }}
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
            <h2 class="section-title heading-imperial">Форма отклика</h2>
            <p class="section-subtitle">Заполните форму, и мы свяжемся с вами для обсуждения сотрудничества</p>
            <form action="{{ route('developers.apply', ['locale' => app()->getLocale()]) }}" method="POST" class="form" data-ajax>
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
                    <input type="text" id="contact" name="contact" class="form-input" required placeholder="email@example.com или @telegram">
                    @error('contact')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="stack" class="form-label">Стек технологий</label>
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
                    <label for="portfolio" class="form-label">Портфолио</label>
                    <input type="url" id="portfolio" name="portfolio" class="form-input" placeholder="https://example.com">
                    @error('portfolio')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">Сообщение</label>
                    <textarea id="message" name="message" class="form-textarea" placeholder="Расскажите о себе, опыте работы, почему хотите работать с нами..."></textarea>
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
