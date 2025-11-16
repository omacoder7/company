@extends('admin.layouts.layout')

@section('title', 'Дашборд')

@section('content')
<div class="admin-header">
    <h1>Dashboard</h1>
</div>

<div class="grid grid-3">
    <div class="card">
        <h3>Услуги</h3>
        <p style="font-size: 2rem; font-weight: var(--font-weight-bold);">{{ $stats['services'] }}</p>
        <a href="{{ route('admin.services.index') }}" class="btn">Управление</a>
    </div>
    <div class="card">
        <h3>Кейсы</h3>
        <p style="font-size: 2rem; font-weight: var(--font-weight-bold);">{{ $stats['cases'] }}</p>
        <a href="{{ route('admin.cases.index') }}" class="btn">Управление</a>
    </div>
    <div class="card">
        <h3>Задачи</h3>
        <p style="font-size: 2rem; font-weight: var(--font-weight-bold);">{{ $stats['tasks'] }}</p>
        <a href="{{ route('admin.developer-tasks.index') }}" class="btn">Управление</a>
    </div>
</div>
@endsection

