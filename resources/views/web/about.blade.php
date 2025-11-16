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
            
            <h2 style="margin-top: var(--spacing-xl); margin-bottom: var(--spacing-md);">Основные принципы</h2>
            <div class="grid grid-2" style="margin-top: var(--spacing-md);">
                <div class="card">
                    <h3>Качество кода</h3>
                    <p class="card-text">{{ $content['principle_1'] ?? 'Строгие стандарты разработки, код-ревью на каждом этапе, тестирование.' }}</p>
                </div>
                <div class="card">
                    <h3>Соблюдение сроков</h3>
                    <p class="card-text">{{ $content['principle_2'] ?? 'Четкие дедлайны, регулярные отчеты, прозрачная коммуникация.' }}</p>
                </div>
                <div class="card">
                    <h3>Профессионализм</h3>
                    <p class="card-text">{{ $content['principle_3'] ?? 'Опытная команда, современные технологии, лучшие практики.' }}</p>
                </div>
                <div class="card">
                    <h3>Конфиденциальность</h3>
                    <p class="card-text">{{ $content['principle_4'] ?? 'Строгое соблюдение NDA, защита данных клиентов.' }}</p>
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

