@php
    $type = $section['type'] ?? 'text';
    $items = $section['items'] ?? '';
    $itemsValue = is_array($items) ? implode("\n", $items) : $items;
    $details = $section['details'] ?? [];
@endphp

<div class="case-section-block" data-section data-section-index="{{ $index }}">
    <div class="case-section-header">
        <strong>Контентный блок</strong>
        <button type="button" class="case-section-remove" data-remove-section>Удалить</button>
    </div>

    <div class="form-group">
        <label class="form-label">Заголовок блока</label>
        <input
            type="text"
            name="sections[{{ $index }}][title]"
            class="form-input"
            value="{{ $section['title'] ?? '' }}"
            placeholder="Например: Проблемы клиента">
    </div>

    <div class="form-group">
        <label class="form-label">Тип содержимого</label>
        <select name="sections[{{ $index }}][type]" class="form-input" data-section-type>
            <option value="text" {{ $type === 'text' ? 'selected' : '' }}>Текст / HTML</option>
            <option value="list" {{ $type === 'list' ? 'selected' : '' }}>Список</option>
            <option value="details" {{ $type === 'details' ? 'selected' : '' }}>Инфо-блок</option>
        </select>
    </div>

    <div class="form-group section-field-text" style="{{ $type === 'text' ? '' : 'display:none;' }}">
        <label class="form-label">Контент блока</label>
        <textarea
            name="sections[{{ $index }}][content]"
            class="form-textarea"
            rows="4"
            placeholder="Можно использовать абзацы, ссылки, выделение HTML.">{{ $section['content'] ?? '' }}</textarea>
        <p class="case-section-hint">Поддерживается HTML, можно создавать списки, ссылки, выделения.</p>
    </div>

    <div class="form-group section-field-list" style="{{ $type === 'list' ? '' : 'display:none;' }}">
        <label class="form-label">Пункты списка</label>
        <textarea
            name="sections[{{ $index }}][items]"
            class="form-textarea"
            rows="4"
            placeholder="Каждый пункт с новой строки.">{{ $itemsValue }}</textarea>
        <p class="case-section-hint">Каждый пункт — новая строка. HTML внутри пункта также поддерживается.</p>
    </div>

    <div class="form-group section-field-details" data-section-details data-next-detail-index="{{ is_array($details) ? count($details) : 0 }}" style="{{ $type === 'details' ? '' : 'display:none;' }}">
        <label class="form-label">Пункты инфо-блока</label>
        <div class="case-details-list" data-details-container>
            @forelse($details as $detailIndex => $detail)
            <div class="case-detail-row" data-detail-row>
                <div class="case-detail-input">
                    <input
                        type="text"
                        name="sections[{{ $index }}][details][{{ $detailIndex }}][label]"
                        class="form-input"
                        value="{{ $detail['label'] ?? '' }}"
                        placeholder="Подпись, например «Клиент»">
                </div>
                <div class="case-detail-input">
                    <input
                        type="text"
                        name="sections[{{ $index }}][details][{{ $detailIndex }}][value]"
                        class="form-input"
                        value="{{ $detail['value'] ?? '' }}"
                        placeholder="Значение, например «Retail Group»">
                </div>
                <button type="button" class="case-detail-remove" data-remove-detail title="Удалить пункт">×</button>
            </div>
            @empty
            @endforelse
        </div>
        <button type="button" class="btn btn-secondary" data-add-detail style="margin-top: var(--spacing-sm);">Добавить пункт</button>
        <p class="case-section-hint">Используйте для пар «подпись — значение»: клиент, ниша, бюджет, сроки и др.</p>
        <template data-detail-template>
            <div class="case-detail-row" data-detail-row>
                <div class="case-detail-input">
                    <input
                        type="text"
                        name="sections[__INDEX__][details][__DETAIL_INDEX__][label]"
                        class="form-input"
                        placeholder="Подпись, например «Клиент»">
                </div>
                <div class="case-detail-input">
                    <input
                        type="text"
                        name="sections[__INDEX__][details][__DETAIL_INDEX__][value]"
                        class="form-input"
                        placeholder="Значение, например «Retail Group»">
                </div>
                <button type="button" class="case-detail-remove" data-remove-detail title="Удалить пункт">×</button>
            </div>
        </template>
    </div>
</div>

