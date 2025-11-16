# Сайт студии разработки

Премиальный минималистичный сайт студии/компании с премиальным дизайном в темно-зеленых тонах.

## Установка

1. Установите зависимости:
```bash
composer install
npm install
```

2. Настройте `.env` файл:
```bash
cp .env.example .env
php artisan key:generate
```

3. Настройте базу данных в `.env`:
```
DB_CONNECTION=sqlite
# или
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

4. Выполните миграции и заполните базу тестовыми данными:
```bash
php artisan migrate
php artisan db:seed
```

Это создаст:
- 6 услуг
- 6 кейсов
- 5 задач для разработчиков
- Пользователя admin@example.com (пароль: password)

5. Создайте симлинк для storage:
```bash
php artisan storage:link
```

6. Соберите фронтенд:
```bash
npm run build
# или для разработки
npm run dev
```

7. Запустите сервер:
```bash
php artisan serve
```

## Настройка

### Email

Настройте отправку email в `.env`:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Telegram

Для отправки уведомлений в Telegram создайте бота через @BotFather и получите webhook URL.

Добавьте в `.env`:
```
TELEGRAM_WEBHOOK_URL=https://api.telegram.org/bot<YOUR_BOT_TOKEN>/sendMessage?chat_id=<YOUR_CHAT_ID>&text=
```

### Аутентификация

Для доступа к админке создайте пользователя:
```bash
php artisan tinker
```

Затем в tinker:
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@example.com';
$user->password = Hash::make('your_password');
$user->save();
```

Или используйте стандартную систему аутентификации Laravel.

## Структура

- `resources/views/` - Blade шаблоны
- `resources/css/app.css` - Основные стили
- `resources/js/app.js` - JavaScript
- `app/Http/Controllers/` - Контроллеры
- `app/Models/` - Модели
- `routes/web.php` - Роуты
- `database/migrations/` - Миграции

## Админка

Админка доступна по адресу `/admin` (требуется аутентификация).

Возможности:
- Управление контентом страниц
- Управление услугами
- Управление кейсами
- Управление задачами для разработчиков
- Просмотр заявок и заявок от разработчиков

## Страницы

- `/` - Главная
- `/about` - О компании
- `/services` - Услуги
- `/cases` - Кейсы
- `/cases/{id}` - Детальная страница кейса
- `/developers` - Для разработчиков
- `/contacts` - Контакты
- `/admin` - Админка

## Технологии

- Laravel 12
- Blade шаблоны
- CSS (премиальный минималистичный дизайн)
- JavaScript (Vanilla)
- Vite для сборки фронтенда

## Лицензия

MIT
