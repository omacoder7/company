@extends('admin.layouts.layout')

@section('title', 'Задачи для разработчиков')

@section('content')
<div class="admin-header">
    <h1>Задачи для разработчиков</h1>
    <a href="{{ route('admin.developer-tasks.create') }}" class="btn btn-primary">Добавить задачу</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Название</th>
            <th>Стек</th>
            <th>Формат</th>
            <th>Порядок</th>
            <th>Активна</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->stack ?? '-' }}</td>
            <td>{{ $task->format ?? '-' }}</td>
            <td>{{ $task->order }}</td>
            <td>
                @if($task->is_active)
                <span class="badge badge-success">Да</span>
                @else
                <span class="badge badge-danger">Нет</span>
                @endif
            </td>
            <td>
                <div style="display: flex; flex-direction: column; gap: 0.5rem; width: fit-content;">
                    <a href="{{ route('admin.developer-tasks.edit', $task->id) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.5rem; width: 100%;">Редактировать</a>
                    <form action="{{ route('admin.developer-tasks.destroy', $task->id) }}" method="POST" style="display: inline; width: 100%;">
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

