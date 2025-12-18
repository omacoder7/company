<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>@yield('meta_title', 'HeroComputer - Technology. Discipline. Results.')</title>
    <meta name="description" content="@yield('meta_description', 'HeroComputer - We change the world with technology. We create systems that help generate maximum revenue—for our clients and for us.')">
    <meta name="keywords" content="@yield('meta_keywords', 'HeroComputer, technology company, web development, mobile development, backend development, API development, DevOps, software development')">
    <meta name="author" content="HeroComputer">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#dc143c">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'HeroComputer - Technology. Discipline. Results.')">
    <meta property="og:description" content="@yield('og_description', 'HeroComputer - We change the world with technology. We create systems that help generate maximum revenue—for our clients and for us.')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:site_name" content="HeroComputer">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    <meta property="og:locale" content="{{ app()->getLocale() === 'ru' ? 'ru_RU' : (app()->getLocale() === 'az' ? 'az_AZ' : 'en_US') }}">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'HeroComputer - Technology. Discipline. Results.')">
    <meta name="twitter:description" content="@yield('twitter_description', 'HeroComputer - We change the world with technology. We create systems that help generate maximum revenue—for our clients and for us.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-image.jpg'))">
    
    @stack('meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8364101418186684"
        crossorigin="anonymous"></script>
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
        .locale-switcher {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .locale-link {
            transition: all 0.3s ease;
        }
        .locale-link:hover:not(.active) {
            background-color: rgba(220, 20, 60, 0.1) !important;
            border-color: rgba(220, 20, 60, 0.3) !important;
        }
        .locale-link.active {
            cursor: default;
        }
        @media (max-width: 767px) {
            .locale-switcher {
                margin-left: 10px;
                gap: 2px;
            }
            .locale-link {
                padding: 4px 8px;
                font-size: 12px;
                min-width: 35px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="logo" style="color: var(--color-red-imperial);">STUDIO</a>
                <ul class="nav-menu">
                    <li><a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('common.home') }}</a></li>
                    <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('common.about') }}</a></li>
                    <li><a href="{{ route('services', ['locale' => app()->getLocale()]) }}">{{ __('common.services') }}</a></li>
                    <li><a href="{{ route('cases', ['locale' => app()->getLocale()]) }}">{{ __('common.cases') }}</a></li>
                    <li><a href="{{ route('developers', ['locale' => app()->getLocale()]) }}">{{ __('common.developers') }}</a></li>
                    <li><a href="{{ route('contacts', ['locale' => app()->getLocale()]) }}">{{ __('common.contacts') }}</a></li>
                </ul>
                <button class="locale-switcher-btn" onclick="openLanguageModal()" style="margin-left: 20px; padding: 8px 16px; background-color: transparent; border: 1px solid var(--color-red-imperial, #dc143c); border-radius: 4px; color: var(--color-red-imperial, #dc143c); cursor: pointer; font-weight: 500; transition: all 0.3s; display: flex; align-items: center; gap: 8px;">
                    <span>{{ strtoupper(app()->getLocale()) }}</span>
                    <span style="font-size: 12px;">▼</span>
                </button>
                <button class="nav-toggle" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>


    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3 style="color: var(--color-red-imperial);">STUDIO</h3>
                    <p>{{ __('pages.company_description') }}</p>
                </div>
                <div class="footer-section">
                    <h4>{{ __('common.navigation') }}</h4>
                    <ul>
                        <li><a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('common.home') }}</a></li>
                        <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('common.about') }}</a></li>
                        <li><a href="{{ route('services', ['locale' => app()->getLocale()]) }}">{{ __('common.services') }}</a></li>
                        <li><a href="{{ route('cases', ['locale' => app()->getLocale()]) }}">{{ __('common.cases') }}</a></li>
                        <li><a href="{{ route('developers', ['locale' => app()->getLocale()]) }}">{{ __('common.developers') }}</a></li>
                        <li><a href="{{ route('contacts', ['locale' => app()->getLocale()]) }}">{{ __('common.contacts') }}</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>{{ __('common.contacts') }}</h4>
                    <p>Email: <a href="mailto:javid.jafarov.ag@gmail.com">javid.jafarov.ag@gmail.com</a></p>
                    <p>Telegram: <a href="https://t.me/flutter_javid_dev">@flutter_javid_dev</a></p>
                    <p style="margin-top: var(--spacing-sm);">
                        <span style="color: var(--color-red-imperial); font-weight: var(--font-weight-bold);">{{ __('common.rate') }}</span>
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} STUDIO. {{ __('pages.rights_reserved') }}</p>
            </div>
        </div>
    </footer>

    <!-- Language Selection Modal -->
    <div id="languageModal" class="language-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 10000; align-items: center; justify-content: center;">
        <div class="language-modal-content" style="background-color: white; padding: 30px; border-radius: 8px; max-width: 400px; width: 90%; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; color: var(--color-red-imperial, #dc143c);">{{ __('pages.select_language') }}</h2>
                <button onclick="closeLanguageModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
            </div>
            <div class="language-options" style="display: flex; flex-direction: column; gap: 12px;">
                @php
                    $currentLocale = app()->getLocale();
                    $locales = [
                        'en' => ['name' => 'English', 'flag' => '🇬🇧'],
                        'ru' => ['name' => 'Русский', 'flag' => '🇷🇺'],
                        'az' => ['name' => 'Azərbaycan', 'flag' => '🇦🇿']
                    ];
                @endphp
                @foreach($locales as $locale => $info)
                    <a href="{{ route('locale.switch', ['locale' => $locale, 'redirect' => url()->current()]) }}" 
                       class="language-option {{ $currentLocale === $locale ? 'active' : '' }}"
                       style="display: flex; align-items: center; gap: 12px; padding: 15px; border: 2px solid {{ $currentLocale === $locale ? 'var(--color-red-imperial, #dc143c)' : '#e0e0e0' }}; border-radius: 6px; text-decoration: none; color: #333; transition: all 0.3s; background-color: {{ $currentLocale === $locale ? 'rgba(220, 20, 60, 0.1)' : 'transparent' }};">
                        <span style="font-size: 24px;">{{ $info['flag'] }}</span>
                        <span style="font-weight: 500; font-size: 16px;">{{ $info['name'] }}</span>
                        @if($currentLocale === $locale)
                            <span style="margin-left: auto; color: var(--color-red-imperial, #dc143c); font-weight: bold;">✓</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function openLanguageModal() {
            document.getElementById('languageModal').style.display = 'flex';
        }
        
        function closeLanguageModal() {
            document.getElementById('languageModal').style.display = 'none';
        }
        
        // Close modal when clicking outside
        document.getElementById('languageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLanguageModal();
            }
        });
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLanguageModal();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>

