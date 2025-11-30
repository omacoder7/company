# Локализация проекта

Проект поддерживает 3 языка: **Английский (en)**, **Русский (ru)**, **Азербайджанский (az)**

## Структура

### Языковые файлы
Языковые файлы находятся в папке `lang/`:
- `lang/en/common.php` - английские переводы
- `lang/ru/common.php` - русские переводы  
- `lang/az/common.php` - азербайджанские переводы

### База данных
Для каждой модели созданы таблицы переводов:
- `service_translations` - переводы услуг
- `case_study_translations` - переводы кейсов
- `developer_task_translations` - переводы задач разработчиков
- `page_content_translations` - переводы контента страниц

## Использование

### В контроллерах

```php
// Получить переведенное значение
$service->title; // Автоматически использует текущую локаль

// Получить перевод для конкретной локали
$service->getTitle('ru');

// Сохранить перевод
$service->saveTranslation('en', [
    'title' => 'Service Title',
    'description' => 'Service Description',
    // ...
]);
```

### В представлениях (Blade)

```blade
{{ __('common.home') }}
{{ $service->title }}
{{ $service->getTitle('ru') }}
```

### Маршруты

Все публичные маршруты имеют языковой префикс:
- `/en/` - английский
- `/ru/` - русский
- `/az/` - азербайджанский

Примеры:
- `/en/services` - услуги на английском
- `/ru/services` - услуги на русском
- `/az/services` - услуги на азербайджанском

### Хелпер LocaleHelper

```php
use App\Helpers\LocaleHelper;

// Получить текущую локаль
LocaleHelper::current();

// Переключить локаль
LocaleHelper::switch('ru');

// Сгенерировать маршрут с локалью
LocaleHelper::route('services', [], 'ru');

// Получить название локали
LocaleHelper::getLocaleName('ru'); // "Русский"
```

## Миграции

Для применения миграций выполните:

```bash
php artisan migrate
```

Это создаст таблицы переводов в базе данных.

## Модели с поддержкой переводов

- `Service` - услуги
- `CaseStudy` - кейсы
- `DeveloperTask` - задачи разработчиков
- `PageContent` - контент страниц

Все эти модели используют трейт `Translatable` и имеют отношения `translations()`.

## Middleware

`SetLocale` middleware автоматически определяет язык пользователя из:
1. Параметра маршрута `{locale}`
2. Сессии
3. Заголовка `Accept-Language`
4. Дефолтной локали из конфигурации

