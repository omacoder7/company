@php
    $prefix = $prefix ?? 'sections';
    $preparedSections = collect($initialSections ?? [])->map(function ($section) {
        return [
            'title' => $section['title'] ?? '',
            'type' => $section['type'] ?? 'text',
            'content' => $section['content'] ?? '',
            'items' => $section['items'] ?? '',
            'details' => $section['details'] ?? [],
        ];
    })->toArray();
    $sectionsId = 'case-sections-' . ($locale ?? 'default');
@endphp

<div class="form-group">
    <label class="form-label">Гибкие блоки кейса</label>
    <p class="case-section-hint">
        Собирайте структуру кейса из блоков: текст, списки или инфо-блоки с парами «подпись — значение» (клиент, ниша, бюджет и т.д.).
    </p>
</div>

<div id="{{ $sectionsId }}" class="case-sections" data-next-index="{{ count($preparedSections) }}" data-prefix="{{ $prefix }}">
    @forelse($preparedSections as $index => $section)
        @include('admin.cases.partials.section-block', ['index' => $index, 'section' => $section, 'prefix' => $prefix])
    @empty
        <div class="case-section-empty" data-empty-state>
            <p>Пока нет блоков. Нажмите «Добавить блок», чтобы создать структуру кейса.</p>
        </div>
    @endforelse
</div>

<button type="button" class="btn btn-secondary case-sections-add" data-sections-id="{{ $sectionsId }}" style="margin-bottom: var(--spacing-lg);">Добавить блок</button>

<template id="case-section-template-{{ $sectionsId }}">
    @include('admin.cases.partials.section-block', ['index' => '__INDEX__', 'section' => ['title' => '', 'type' => 'text', 'content' => '', 'items' => '', 'details' => []], 'prefix' => $prefix])
</template>

@once
@push('scripts')
<style>
    .case-sections {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-md);
        margin-bottom: var(--spacing-md);
    }
    .case-section-block {
        border: 1px solid var(--color-border);
        border-radius: var(--border-radius);
        padding: var(--spacing-md);
        background-color: var(--color-gray-light);
    }
    .case-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: var(--spacing-sm);
    }
    .case-section-remove {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-weight: var(--font-weight-medium);
    }
    .case-section-hint {
        font-size: 0.875rem;
        color: var(--color-text-muted, #666);
        margin-top: var(--spacing-xs);
    }
    .case-details-list {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-sm);
    }
    .case-detail-row {
        display: flex;
        gap: var(--spacing-sm);
        align-items: center;
    }
    .case-detail-input {
        flex: 1;
    }
    .case-detail-remove {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 1.25rem;
        line-height: 1;
        padding: 0 var(--spacing-xs);
    }
    .case-section-empty {
        padding: var(--spacing-md);
        border: 1px dashed var(--color-border);
        border-radius: var(--border-radius);
        color: var(--color-text-muted, #666);
        background-color: var(--color-gray-light);
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle multiple section containers (one per language)
        document.querySelectorAll('.case-sections').forEach(container => {
            const sectionsId = container.id;
            // Find button by data attribute - search within the same language-content parent
            const languageContent = container.closest('.language-content');
            let addButton = null;
            
            if (languageContent) {
                // First try to find button in the same language-content
                addButton = languageContent.querySelector(`[data-sections-id="${sectionsId}"]`);
            }
            
            // If not found, try global search
            if (!addButton) {
                addButton = document.querySelector(`[data-sections-id="${sectionsId}"]`);
            }
            
            const template = document.getElementById(`case-section-template-${sectionsId}`);
            const prefix = container.dataset.prefix || 'sections';

            if (!container) {
                return;
            }
            
            if (!addButton) {
                return;
            }
            
            if (!template) {
                return;
            }
            
            const updateEmptyState = () => {
                const emptyState = container.querySelector('[data-empty-state]');
                if (emptyState) {
                    if (container.querySelector('[data-section]')) {
                        emptyState.remove();
                    }
                } else if (!container.querySelector('[data-section]')) {
                    const clone = document.createElement('div');
                    clone.className = 'case-section-empty';
                    clone.dataset.emptyState = 'true';
                    clone.innerHTML = '<p>Пока нет блоков. Нажмите «Добавить блок», чтобы создать структуру кейса.</p>';
                    container.appendChild(clone);
                }
            };

            const setupSectionBlock = (block) => {
                const typeSelect = block.querySelector('[data-section-type]');
                const textField = block.querySelector('.section-field-text');
                const listField = block.querySelector('.section-field-list');
                const detailsField = block.querySelector('.section-field-details');
                const removeButton = block.querySelector('[data-remove-section]');

                if (typeSelect) {
                    const toggleFields = () => {
                        if (textField) textField.style.display = 'none';
                        if (listField) listField.style.display = 'none';
                        if (detailsField) detailsField.style.display = 'none';

                        if (typeSelect.value === 'list' && listField) {
                            listField.style.display = '';
                        } else if (typeSelect.value === 'details' && detailsField) {
                            detailsField.style.display = '';
                        } else if (textField) {
                            textField.style.display = '';
                        }
                    };
                    typeSelect.addEventListener('change', toggleFields);
                    toggleFields();
                }

                const setupDetailsField = () => {
                    if (!detailsField) {
                        return;
                    }

                    const detailsContainer = detailsField.querySelector('[data-details-container]');
                    const addDetailButton = detailsField.querySelector('[data-add-detail]');
                    const detailTemplate = detailsField.querySelector('[data-detail-template]');
                    const sectionIndex = block.dataset.sectionIndex;

                    if (!detailsContainer || !addDetailButton || !detailTemplate) {
                        return;
                    }

                    const attachRowHandlers = (row) => {
                        const removeBtn = row.querySelector('[data-remove-detail]');
                        if (removeBtn) {
                            removeBtn.addEventListener('click', () => {
                                row.remove();
                            });
                        }
                    };

                    detailsContainer.querySelectorAll('[data-detail-row]').forEach(attachRowHandlers);

                    addDetailButton.addEventListener('click', () => {
                        const nextDetailIndex = Number(detailsField.dataset.nextDetailIndex || detailsContainer.children.length || 0);
                        detailsField.dataset.nextDetailIndex = nextDetailIndex + 1;

                        const templateHtml = detailTemplate.innerHTML
                            .replace(/__INDEX__/g, sectionIndex)
                            .replace(/__DETAIL_INDEX__/g, nextDetailIndex);

                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = templateHtml.trim();
                        const newRow = wrapper.firstElementChild;
                        detailsContainer.appendChild(newRow);
                        attachRowHandlers(newRow);
                    });
                };

                setupDetailsField();

                if (removeButton) {
                    removeButton.addEventListener('click', () => {
                        block.remove();
                        updateEmptyState();
                    });
                }
            };

            const initExistingBlocks = () => {
                container.querySelectorAll('[data-section]').forEach(setupSectionBlock);
            };

            const addSection = (e) => {
                if (e) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                
                // Only add section if this container is visible
                const languageContent = container.closest('.language-content');
                if (languageContent && languageContent.style.display === 'none') {
                    return false;
                }
                
                const nextIndex = Number(container.dataset.nextIndex || 0);
                container.dataset.nextIndex = nextIndex + 1;

                if (!template || !template.innerHTML) {
                    return false;
                }
                
                const templateHtml = template.innerHTML.replace(/__INDEX__/g, nextIndex);
                
                const tempWrapper = document.createElement('div');
                tempWrapper.innerHTML = templateHtml.trim();
                const newBlock = tempWrapper.firstElementChild;
                
                if (!newBlock) {
                    return false;
                }
                
                container.appendChild(newBlock);
                setupSectionBlock(newBlock);
                updateEmptyState();
                
                return false;
            };

            // Add event listener to button - only one handler to prevent duplicates
            addButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                addSection(e);
            });
            
            initExistingBlocks();
            updateEmptyState();
        });
    }); // Close DOMContentLoaded
</script>
@endpush
@endonce

