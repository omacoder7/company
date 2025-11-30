<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Админка')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        .admin-sidebar {
            width: 250px;
            background-color: var(--color-primary-dark);
            padding: var(--spacing-md);
            border-right: 1px solid var(--color-border);
            display: flex;
            flex-direction: column;
        }
        .admin-sidebar h2 {
            margin-bottom: var(--spacing-lg);
            color: var(--color-white);
        }
        .admin-sidebar ul {
            list-style: none;
            flex: 1;
        }
        .admin-sidebar ul li {
            margin-bottom: var(--spacing-xs);
        }
        .admin-sidebar ul li a {
            display: block;
            padding: var(--spacing-sm);
            color: var(--color-text);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }
        .admin-sidebar ul li a:hover,
        .admin-sidebar ul li a.active {
            background-color: var(--color-primary);
            color: var(--color-white);
        }
        .admin-content {
            flex: 1;
            padding: var(--spacing-lg);
        }
        .admin-header {
            margin-bottom: var(--spacing-lg);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--color-gray);
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        .admin-table th,
        .admin-table td {
            padding: var(--spacing-sm);
            text-align: left;
            border-bottom: 1px solid var(--color-border);
        }
        .admin-table th {
            background-color: var(--color-primary-dark);
            color: var(--color-white);
            font-weight: var(--font-weight-semibold);
        }
        .admin-table tr:hover {
            background-color: var(--color-gray-light);
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: var(--border-radius);
            font-size: 0.875rem;
            font-weight: var(--font-weight-medium);
        }
        .badge-success {
            background-color: var(--color-primary);
            color: var(--color-white);
        }
        .badge-danger {
            background-color: #dc3545;
            color: var(--color-white);
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <a href="{{ route('admin.dashboard') }}" class="logo">STUDIO</a>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('admin.pages') }}" class="{{ request()->routeIs('admin.pages') ? 'active' : '' }}">Контент страниц</a></li>
                <li><a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">Услуги</a></li>
                <li><a href="{{ route('admin.cases.index') }}" class="{{ request()->routeIs('admin.cases.*') ? 'active' : '' }}">Кейсы</a></li>
                <li><a href="{{ route('admin.developer-tasks.index') }}" class="{{ request()->routeIs('admin.developer-tasks.*') ? 'active' : '' }}">Задачи для разработчиков</a></li>
                <li><a href="{{ route('home', ['locale' => session('locale', config('app.locale', 'en'))]) }}">На сайт</a></li>
            </ul>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: auto; padding-top: var(--spacing-lg);">
                @csrf
                <button type="submit" style="width: 100%; padding: var(--spacing-sm); background-color: #dc3545; color: var(--color-white); border: none; border-radius: var(--border-radius); cursor: pointer; font-weight: var(--font-weight-medium);">
                    Выйти
                </button>
            </form>
        </aside>
        <main class="admin-content">
            @if(session('success'))
            <div class="form-success" style="margin-bottom: var(--spacing-md);">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>

