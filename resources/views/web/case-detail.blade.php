@extends('web.layouts.app')

@section('title', $case->title)

@section('content')
<section class="section">
    <div class="container" style="max-width: 900px;">
        <a href="{{ route('cases', ['locale' => app()->getLocale()]) }}" class="btn btn-secondary" style="margin-bottom: var(--spacing-md);">← {{ __('pages.back_to_cases') }}</a>
        
        @if($case->image)
        <img src="{{ asset('storage/' . $case->image) }}" alt="{{ $case->title }}" style="width: 100%; height: 400px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: var(--spacing-lg);">
        @endif
        
        <h1>{{ $case->title }}</h1>
        
        @php
            $sections = $case->sections ?? [];
        @endphp

        @if(!empty($sections))
            @foreach($sections as $section)
                @php
                    $type = $section['type'] ?? 'text';
                    $title = $section['title'] ?? null;
                    $content = $section['content'] ?? null;
                    $items = $section['items'] ?? [];
                    $details = $section['details'] ?? [];
                    $image = $section['image'] ?? null;
                @endphp
                <div class="case-content-block" style="margin-bottom: var(--spacing-lg);">
                    @if($title)
                        <h2>{{ $title }}</h2>
                    @endif

                    @if($image)
                        <div style="margin-bottom: var(--spacing-md);">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $title ?? $case->title }}" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: var(--border-radius);">
                        </div>
                    @endif

                    @if($type === 'details' && !empty($details))
                        <div class="case-details-grid" style="display: flex; flex-wrap: wrap; gap: var(--spacing-md);">
                            @foreach($details as $detail)
                                <div style="min-width: 180px;">
                                    @if(!empty($detail['label']))
                                        <strong style="display: block; color: var(--color-text-muted); text-transform: uppercase; font-size: 0.85rem;">
                                            {{ $detail['label'] }}
                                        </strong>
                                    @endif
                                    <div style="font-size: 1.05rem; line-height: 1.6;">
                                        {!! $detail['value'] ?? '' !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif($type === 'list' && !empty($items))
                        <ul style="padding-left: 1.25rem; font-size: 1.05rem; line-height: 1.8;">
                            @foreach($items as $item)
                                <li>{!! $item !!}</li>
                            @endforeach
                        </ul>
                    @elseif($content)
                        <div class="case-content-rich" style="font-size: 1.1rem; line-height: 1.8;">
                            {!! $content !!}
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div style="margin-bottom: var(--spacing-lg);">
                <p style="font-size: 1.1rem; line-height: 1.8;">Контент кейса появится скоро.</p>
            </div>
        @endif
        
        <div class="text-center mt-3">
            <a href="{{ route('contacts', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">{{ __('pages.discuss_project') }}</a>
        </div>
    </div>
</section>
@endsection

