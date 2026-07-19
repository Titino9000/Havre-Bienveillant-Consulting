<?php

namespace App\Livewire\Backend\Inquiries\Tables;

use App\Livewire\Components\Tables\BaseTable;
use App\Models\Inquiry;

class InquiriesTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Name', 'field' => 'name', 'searchable' => true, 'sortable' => true],
                ['label' => 'Email', 'field' => 'email', 'searchable' => true, 'sortable' => true],
                ['label' => 'Subject', 'field' => 'subject', 'searchable' => true, 'sortable' => true],
                ['label' => 'Read', 'field' => 'is_read', 'searchable' => false, 'sortable' => true]
            ],
            modelClass: Inquiry::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'Inquiries',
            buttonLabel: 'Add Record'
        );
        $this->formComponent = 'backend.inquiries.forms.inquiry-form';
    }
}
