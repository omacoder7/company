# Настройка .env файла

Создайте файл `.env` на основе `.env.example` (если его нет, создайте новый) и добавьте следующие переменные:

## Обязательные базовые настройки

```env
APP_NAME="Studio"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
```

**Примечание:** После создания `.env` выполните `php artisan key:generate` для генерации `APP_KEY`.

## База данных

### Вариант 1: SQLite (проще для разработки)

```env
DB_CONNECTION=sqlite
```

Файл `database/database.sqlite` будет создан автоматически при миграции.

### Вариант 2: MySQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Вариант 3: PostgreSQL

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Настройка Email (для отправки заявок)

### Вариант 1: SMTP (рекомендуется для продакшена)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

**Для Gmail:** Используйте пароль приложения, а не обычный пароль. Создайте его в настройках аккаунта Google.

### Вариант 2: Mailtrap (для тестирования)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Вариант 3: Log (для разработки, письма сохраняются в лог)

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Настройка Telegram (опционально)

Для отправки уведомлений о новых заявках в Telegram:

1. Создайте бота через [@BotFather](https://t.me/BotFather) в Telegram
2. Получите токен бота
3. Узнайте ваш Chat ID (можно использовать [@userinfobot](https://t.me/userinfobot))
4. Добавьте в `.env`:

```env
TELEGRAM_WEBHOOK_URL=https://api.telegram.org/bot<YOUR_BOT_TOKEN>/sendMessage?chat_id=<YOUR_CHAT_ID>&text=
```

**Пример:**
```env
TELEGRAM_WEBHOOK_URL=https://api.telegram.org/bot123456789:ABCdefGHIjklMNOpqrsTUVwxyz/sendMessage?chat_id=987654321&text=
```

**Примечание:** Если не настроить Telegram, заявки будут отправляться только на email.

## Полный пример .env файла

```env
APP_NAME="Studio"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# База данных (SQLite)
DB_CONNECTION=sqlite

# Или MySQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=studio
# DB_USERNAME=root
# DB_PASSWORD=

# Email
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"

# Telegram (опционально)
TELEGRAM_WEBHOOK_URL=

# Кеш и сессии
CACHE_STORE=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Очереди
QUEUE_CONNECTION=database
```

## После настройки .env

1. Сгенерируйте ключ приложения:
   ```bash
   php artisan key:generate
   ```

2. Выполните миграции:
   ```bash
   php artisan migrate
   ```

3. Создайте симлинк для storage:
   ```bash
   php artisan storage:link
   ```

4. Соберите фронтенд:
   ```bash
   npm run build
   ```

5. Запустите сервер:
   ```bash
   php artisan serve
   ```

## Проверка настроек

После настройки проверьте:

- ✅ Email отправляется (отправьте тестовую заявку)
- ✅ Telegram уведомления работают (если настроено)
- ✅ Изображения загружаются (в админке при создании кейса)
- ✅ Админка доступна (создайте пользователя через tinker)

