@extends('admin.layouts.layout')

@section('title', 'Контент страниц')

@section('content')
<div class="admin-header">
    <h1>Контент страниц</h1>
</div>

<form action="{{ route('admin.pages.update') }}" method="POST">
    @csrf
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Главная - Hero</h2>
    <div class="form-group">
        <label class="form-label">Индикатор скорости</label>
        <input type="text" name="home_hero_speed_indicator" class="form-input" value="{{ $formData['home_hero_speed_indicator'] ?? 'Скорость исполнения' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Заголовок Hero</label>
        <input type="text" name="home_hero_title" class="form-input" value="{{ $formData['home_hero_title'] ?? '' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Текст Hero</label>
        <textarea name="home_hero_text" class="form-textarea">{{ $formData['home_hero_text'] ?? '' }}</textarea>
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Технологическая компания</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="home_technology_company_title" class="form-input" value="{{ $formData['home_technology_company_title'] ?? 'Технологическая компания' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Подзаголовок</label>
        <textarea name="home_technology_company_subtitle" class="form-textarea">{{ $formData['home_technology_company_subtitle'] ?? 'Мы не просто агентство. Мы создаём архитектуры, системы и решения, которые меняют правила игры.' }}</textarea>
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Системы, которые зарабатывают</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="home_profit_systems_title" class="form-input" value="{{ $formData['home_profit_systems_title'] ?? 'Системы, которые зарабатывают' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Подзаголовок</label>
        <textarea name="home_profit_systems_subtitle" class="form-textarea">{{ $formData['home_profit_systems_subtitle'] ?? 'Мы делаем проекты, которые приносят максимальную прибыль. Для клиентов. Для нас. Это наш внутренний ориентир.' }}</textarea>
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Против Голиафа</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="home_against_goliath_title" class="form-input" value="{{ $formData['home_against_goliath_title'] ?? 'Против Голиафа' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Подзаголовок</label>
        <textarea name="home_against_goliath_subtitle" class="form-textarea">{{ $formData['home_against_goliath_subtitle'] ?? 'Мы помогаем и маленьким, и крупным компаниям выигрывать за счёт технологий, дисциплины и стратегии.' }}</textarea>
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Услуги</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="home_services_title" class="form-input" value="{{ $formData['home_services_title'] ?? 'Услуги' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Подзаголовок</label>
        <input type="text" name="home_services_subtitle" class="form-input" value="{{ $formData['home_services_subtitle'] ?? 'Направления нашей работы' }}">
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Кейсы</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="home_cases_title" class="form-input" value="{{ $formData['home_cases_title'] ?? 'Кейсы' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Подзаголовок</label>
        <input type="text" name="home_cases_subtitle" class="form-input" value="{{ $formData['home_cases_subtitle'] ?? 'Реализованные проекты, которые приносят результат' }}">
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Наши стандарты</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="home_standards_title" class="form-input" value="{{ $formData['home_standards_title'] ?? 'Наши стандарты' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Подзаголовок</label>
        <textarea name="home_standards_subtitle" class="form-textarea">{{ $formData['home_standards_subtitle'] ?? 'Это не просто слова. Это обязательные требования к каждому проекту и каждому члену команды.' }}</textarea>
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Почасовая ставка</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="home_hourly_rate_title" class="form-input" value="{{ $formData['home_hourly_rate_title'] ?? 'Почасовая ставка' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Сумма ставки</label>
        <input type="text" name="home_hourly_rate_amount" class="form-input" value="{{ $formData['home_hourly_rate_amount'] ?? '$50 / час' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Подзаголовок</label>
        <textarea name="home_hourly_rate_subtitle" class="form-textarea">{{ $formData['home_hourly_rate_subtitle'] ?? 'Без лишних пояснений. Деловой и уверенный подход к ценообразованию.' }}</textarea>
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Для разработчиков</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="home_developers_title" class="form-input" value="{{ $formData['home_developers_title'] ?? 'Для разработчиков' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Текст</label>
        <textarea name="home_developers_text" class="form-textarea">{{ $formData['home_developers_text'] ?? 'Ищем талантливых разработчиков для работы над интересными проектами. Строгие стандарты, качественный код, справедливая оплата.' }}</textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Ставка</label>
        <input type="text" name="home_developers_rate" class="form-input" value="{{ $formData['home_developers_rate'] ?? '$50 / час' }}">
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">Форма обратной связи</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="home_contact_title" class="form-input" value="{{ $formData['home_contact_title'] ?? 'Обсудить проект' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Подзаголовок</label>
        <textarea name="home_contact_subtitle" class="form-textarea">{{ $formData['home_contact_subtitle'] ?? 'Готовы начать? Расскажите о вашем проекте, и мы обсудим, как технологии помогут вам зарабатывать больше.' }}</textarea>
    </div>
    
    <h2 style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-md);">О компании</h2>
    <div class="form-group">
        <label class="form-label">Заголовок</label>
        <input type="text" name="about_title" class="form-input" value="{{ $formData['about_title'] ?? '' }}">
    </div>
    <div class="form-group">
        <label class="form-label">Описание</label>
        <textarea name="about_description" class="form-textarea">{{ $formData['about_description'] ?? '' }}</textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection

