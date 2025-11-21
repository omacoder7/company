@extends('admin.layouts.layout')

@section('title', 'Кейсы')

@section('content')
<div class="admin-header">
    <h1>Кейсы</h1>
    <a href="{{ route('admin.cases.create') }}" class="btn btn-primary">Добавить кейс</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Изображение</th>
            <th>Название</th>
            <th>Ключевые факты</th>
            <th>Порядок</th>
            <th>Активен</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cases as $case)
        <tr>
            <td>
                @if($case->image)
                <img src="{{ asset('storage/' . $case->image) }}" alt="{{ $case->title }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                @else
                <span style="color: #999;">Нет изображения</span>
                @endif
            </td>
            <td>{{ $case->title }}</td>
            @php
                $primaryDetails = collect($case->primary_details ?? [])->take(2);
            @endphp
            <td>
                @if($primaryDetails->isNotEmpty())
                    @foreach($primaryDetails as $detail)
                        <div>
                            @if(!empty($detail['label']))
                                <strong>{{ $detail['label'] }}:</strong>
                            @endif
                            {{ strip_tags($detail['value'] ?? '') }}
                        </div>
                    @endforeach
                @else
                    <span>-</span>
                @endif
            </td>
            <td>{{ $case->order }}</td>
            <td>
                @if($case->is_active)
                <span class="badge badge-success">Да</span>
                @else
                <span class="badge badge-danger">Нет</span>
                @endif
            </td>
            <td>
                <div style="display: flex; flex-direction: column; gap: 0.5rem; width: fit-content;">
                    <a href="{{ route('admin.cases.edit', $case->id) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.5rem; width: 100%;">Редактировать</a>
                    <form action="{{ route('admin.cases.destroy', $case->id) }}" method="POST" style="display: inline; width: 100%;">
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