@extends('admin.layouts.layout')

@section('title', 'Контент страниц')

@section('content')
<div class="admin-header">
    <h1>Контент страниц</h1>
</div>

<form action="{{ route('admin.pages.update') }}" method="POST">
    @csrf
    
    <!-- Language Tabs -->
    <div class="language-tabs" style="margin-bottom: var(--spacing-lg); border-bottom: 2px solid var(--color-border);">
        <button type="button" class="lang-tab active" data-lang="ru" onclick="switchLanguage('ru')">🇷🇺 Русский</button>
        <button type="button" class="lang-tab" data-lang="en" onclick="switchLanguage('en')">🇬🇧 English</button>
        <button type="button" class="lang-tab" data-lang="az" onclick="switchLanguage('az')">🇦🇿 Azərbaycan</button>
    </div>
    
    @foreach(['ru', 'en', 'az'] as $locale)
    <div class="language-content" id="lang-{{ $locale }}" style="display: {{ $locale === 'ru' ? 'block' : 'none' }};">
        <h2 style="margin-bottom: var(--spacing-md); color: var(--color-primary);">
            @if($locale === 'ru') Русский
            @elseif($locale === 'en') English
            @else Azərbaycan
            @endif
        </h2>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Главная - Hero</h2>
        <div class="form-group">
            <label class="form-label">Индикатор скорости</label>
            <input type="text" name="home_hero_speed_indicator_{{ $locale }}" class="form-input" value="{{ $formData['home_hero_speed_indicator_' . $locale] ?? ($locale === 'ru' ? 'Скорость исполнения' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Заголовок Hero</label>
            <input type="text" name="home_hero_title_{{ $locale }}" class="form-input" value="{{ $formData['home_hero_title_' . $locale] ?? '' }}">
        </div>
        <div class="form-group">
            <label class="form-label">Текст Hero</label>
            <textarea name="home_hero_text_{{ $locale }}" class="form-textarea">{{ $formData['home_hero_text_' . $locale] ?? '' }}</textarea>
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Технологическая компания</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="home_technology_company_title_{{ $locale }}" class="form-input" value="{{ $formData['home_technology_company_title_' . $locale] ?? ($locale === 'ru' ? 'Технологическая компания' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Подзаголовок</label>
            <textarea name="home_technology_company_subtitle_{{ $locale }}" class="form-textarea">{{ $formData['home_technology_company_subtitle_' . $locale] ?? ($locale === 'ru' ? 'Мы не просто агентство. Мы создаём архитектуры, системы и решения, которые меняют правила игры.' : '') }}</textarea>
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Системы, которые зарабатывают</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="home_profit_systems_title_{{ $locale }}" class="form-input" value="{{ $formData['home_profit_systems_title_' . $locale] ?? ($locale === 'ru' ? 'Системы, которые зарабатывают' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Подзаголовок</label>
            <textarea name="home_profit_systems_subtitle_{{ $locale }}" class="form-textarea">{{ $formData['home_profit_systems_subtitle_' . $locale] ?? ($locale === 'ru' ? 'Мы делаем проекты, которые приносят максимальную прибыль. Для клиентов. Для нас. Это наш внутренний ориентир.' : '') }}</textarea>
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Против Голиафа</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="home_against_goliath_title_{{ $locale }}" class="form-input" value="{{ $formData['home_against_goliath_title_' . $locale] ?? ($locale === 'ru' ? 'Против Голиафа' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Подзаголовок</label>
            <textarea name="home_against_goliath_subtitle_{{ $locale }}" class="form-textarea">{{ $formData['home_against_goliath_subtitle_' . $locale] ?? ($locale === 'ru' ? 'Мы помогаем и маленьким, и крупным компаниям выигрывать за счёт технологий, дисциплины и стратегии.' : '') }}</textarea>
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Услуги</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="home_services_title_{{ $locale }}" class="form-input" value="{{ $formData['home_services_title_' . $locale] ?? ($locale === 'ru' ? 'Услуги' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Подзаголовок</label>
            <input type="text" name="home_services_subtitle_{{ $locale }}" class="form-input" value="{{ $formData['home_services_subtitle_' . $locale] ?? ($locale === 'ru' ? 'Направления нашей работы' : '') }}">
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Кейсы</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="home_cases_title_{{ $locale }}" class="form-input" value="{{ $formData['home_cases_title_' . $locale] ?? ($locale === 'ru' ? 'Кейсы' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Подзаголовок</label>
            <input type="text" name="home_cases_subtitle_{{ $locale }}" class="form-input" value="{{ $formData['home_cases_subtitle_' . $locale] ?? ($locale === 'ru' ? 'Реализованные проекты, которые приносят результат' : '') }}">
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Наши стандарты</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="home_standards_title_{{ $locale }}" class="form-input" value="{{ $formData['home_standards_title_' . $locale] ?? ($locale === 'ru' ? 'Наши стандарты' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Подзаголовок</label>
            <textarea name="home_standards_subtitle_{{ $locale }}" class="form-textarea">{{ $formData['home_standards_subtitle_' . $locale] ?? ($locale === 'ru' ? 'Это не просто слова. Это обязательные требования к каждому проекту и каждому члену команды.' : '') }}</textarea>
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Почасовая ставка</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="home_hourly_rate_title_{{ $locale }}" class="form-input" value="{{ $formData['home_hourly_rate_title_' . $locale] ?? ($locale === 'ru' ? 'Почасовая ставка' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Сумма ставки</label>
            <input type="text" name="home_hourly_rate_amount_{{ $locale }}" class="form-input" value="{{ $formData['home_hourly_rate_amount_' . $locale] ?? ($locale === 'ru' ? '$30 / час' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Подзаголовок</label>
            <textarea name="home_hourly_rate_subtitle_{{ $locale }}" class="form-textarea">{{ $formData['home_hourly_rate_subtitle_' . $locale] ?? ($locale === 'ru' ? 'Без лишних пояснений. Деловой и уверенный подход к ценообразованию.' : '') }}</textarea>
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Для разработчиков</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="home_developers_title_{{ $locale }}" class="form-input" value="{{ $formData['home_developers_title_' . $locale] ?? ($locale === 'ru' ? 'Для разработчиков' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Текст</label>
            <textarea name="home_developers_text_{{ $locale }}" class="form-textarea">{{ $formData['home_developers_text_' . $locale] ?? ($locale === 'ru' ? 'Ищем талантливых разработчиков для работы над интересными проектами. Строгие стандарты, качественный код, справедливая оплата.' : '') }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Ставка</label>
            <input type="text" name="home_developers_rate_{{ $locale }}" class="form-input" value="{{ $formData['home_developers_rate_' . $locale] ?? ($locale === 'ru' ? '$30 / час' : '') }}">
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Форма обратной связи</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="home_contact_title_{{ $locale }}" class="form-input" value="{{ $formData['home_contact_title_' . $locale] ?? ($locale === 'ru' ? 'Обсудить проект' : '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Подзаголовок</label>
            <textarea name="home_contact_subtitle_{{ $locale }}" class="form-textarea">{{ $formData['home_contact_subtitle_' . $locale] ?? ($locale === 'ru' ? 'Готовы начать? Расскажите о вашем проекте, и мы обсудим, как технологии помогут вам зарабатывать больше.' : '') }}</textarea>
        </div>
        
        <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">О компании</h2>
        <div class="form-group">
            <label class="form-label">Заголовок</label>
            <input type="text" name="about_title_{{ $locale }}" class="form-input" value="{{ $formData['about_title_' . $locale] ?? '' }}">
        </div>
        <div class="form-group">
            <label class="form-label">Описание</label>
            <textarea name="about_description_{{ $locale }}" class="form-textarea">{{ $formData['about_description_' . $locale] ?? '' }}</textarea>
        </div>
    </div>
    @endforeach
    
    <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-lg); border-top: 2px solid var(--color-border);">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>

<style>
.language-tabs {
    display: flex;
    gap: var(--spacing-xs);
    margin-bottom: var(--spacing-md);
}
.lang-tab {
    padding: var(--spacing-sm) var(--spacing-md);
    background-color: var(--color-gray-light);
    border: 1px solid var(--color-border);
    border-bottom: none;
    border-radius: var(--border-radius) var(--border-radius) 0 0;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s;
}
.lang-tab:hover {
    background-color: var(--color-gray);
}
.lang-tab.active {
    background-color: var(--color-primary);
    color: white;
    border-color: var(--color-primary);
}
.language-content {
    padding: var(--spacing-lg);
    background-color: var(--color-gray-light);
    border-radius: var(--border-radius);
    margin-bottom: var(--spacing-md);
}
</style>

<script>
function switchLanguage(lang) {
    document.querySelectorAll('.language-content').forEach(content => {
        content.style.display = 'none';
    });
    document.querySelectorAll('.lang-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.getElementById('lang-' + lang).style.display = 'block';
    document.querySelector(`.lang-tab[data-lang="${lang}"]`).classList.add('active');
}
</script>
@endsection

