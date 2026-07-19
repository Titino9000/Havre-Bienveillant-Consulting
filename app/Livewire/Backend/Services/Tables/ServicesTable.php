<?php

namespace App\Livewire\Backend\Services\Tables;

use App\Livewire\Components\Tables\BaseTable;
use App\Models\Service;

class ServicesTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Image', 'field' => 'image', 'type' => 'image', 'searchable' => false],
                ['label' => 'Title', 'field' => 'title', 'searchable' => true, 'sortable' => true, 'searchFields' => ['title']],
                ['label' => 'Type', 'field' => 'type', 'type' => 'badge', 'badge_color' => ['counseling' => 'primary', 'workshop' => 'success', 'consulting' => 'info'], 'searchable' => true, 'sortable' => true]
            ],
            modelClass: Service::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'Services',
            buttonLabel: 'Add Record'
        );
        $this->formComponent = 'backend.services.forms.service-form';
    }
}
