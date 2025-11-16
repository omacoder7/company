<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Студия разработки')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        @media (min-width: 768px) {
            .card {
                word-wrap: break-word;
                overflow-wrap: break-word;
                word-break: break-word;
            }
            .card h3,
            .card h2,
            .card h4 {
                word-wrap: break-word;
                overflow-wrap: break-word;
                word-break: break-word;
            }
            .card-text {
                word-wrap: break-word;
                overflow-wrap: break-word;
                word-break: break-word;
                hyphens: auto;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="{{ route('home') }}" class="logo" style="color: var(--color-red-imperial);">STUDIO</a>
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('about') }}">О компании</a></li>
                    <li><a href="{{ route('services') }}">Услуги</a></li>
                    <li><a href="{{ route('cases') }}">Кейсы</a></li>
                    <li><a href="{{ route('developers') }}">Для разработчиков</a></li>
                    <li><a href="{{ route('contacts') }}">Контакты</a></li>
                </ul>
                <button class="nav-toggle" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3 style="color: var(--color-red-imperial);">STUDIO</h3>
                    <p>Технологическая компания. Меняем мир с помощью технологий. Строгие стандарты. Результат.</p>
                </div>
                <div class="footer-section">
                    <h4>Навигация</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Главная</a></li>
                        <li><a href="{{ route('about') }}">О компании</a></li>
                        <li><a href="{{ route('services') }}">Услуги</a></li>
                        <li><a href="{{ route('cases') }}">Кейсы</a></li>
                        <li><a href="{{ route('developers') }}">Для разработчиков</a></li>
                        <li><a href="{{ route('contacts') }}">Контакты</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Контакты</h4>
                    <p>Email: <a href="mailto:info@studio.com">info@studio.com</a></p>
                    <p>Telegram: <a href="https://t.me/studio">@studio</a></p>
                    <p style="margin-top: var(--spacing-sm);">
                        <span style="color: var(--color-red-imperial); font-weight: var(--font-weight-bold);">$50 / час</span>
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} STUDIO. Все права защищены.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

