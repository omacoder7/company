@extends('admin.layouts.layout')

@section('title', 'Услуги')

@section('content')
<div class="admin-header">
    <h1>Услуги</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Добавить услугу</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Название</th>
            <th>Порядок</th>
            <th>Активна</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{ $service->title }}</td>
            <td>{{ $service->order }}</td>
            <td>
                @if($service->is_active)
                <span class="badge badge-success">Да</span>
                @else
                <span class="badge badge-danger">Нет</span>
                @endif
            </td>
            <td>
                <div style="display: flex; flex-direction: column; gap: 0.5rem; width: fit-content;">
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.5rem; width: 100%;">Редактировать</a>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display: inline; width: 100%;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.5rem; background-color: #dc3545; border-color: #dc3545; width: 100%;" onclick="return confirm('Удалить?')">Удалить</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

