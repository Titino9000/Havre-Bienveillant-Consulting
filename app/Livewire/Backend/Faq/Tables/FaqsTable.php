<?php

namespace App\Livewire\Backend\Faq\Tables;

use App\Livewire\Components\Tables\BaseTable;
use App\Models\Faq;

class FaqsTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Question', 'field' => 'question', 'searchable' => true, 'sortable' => true, 'searchFields' => ['question']],
                ['label' => 'Active', 'field' => 'is_active', 'type' => 'badge', 'badge_color' => [1 => 'success', 0 => 'secondary'], 'searchable' => false, 'sortable' => true],
                ['label' => 'Order', 'field' => 'order', 'searchable' => false, 'sortable' => true]
            ],
            modelClass: Faq::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'FAQ',
            buttonLabel: 'Add FAQ'
        );
        $this->formComponent = 'backend.faq.forms.faq-form';
    }
}
