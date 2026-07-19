<?php

namespace App\Livewire\Backend\Monitoring\Tables;

use App\Livewire\Components\Tables\BaseTable;
use App\Models\NotFoundLog;

class NotFoundLogsTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'URL', 'field' => 'url', 'searchable' => true, 'sortable' => true],
                ['label' => 'IP Address', 'field' => 'ip_address', 'searchable' => true, 'sortable' => true],
                ['label' => 'Hits', 'field' => 'hits', 'searchable' => false, 'sortable' => true],
                ['label' => 'Last Accessed', 'field' => 'last_accessed_at', 'searchable' => false, 'sortable' => true]
            ],
            modelClass: NotFoundLog::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: '404 Error Logs',
            buttonLabel: 'Add Log' // not used since we hide create
        );
        $this->showCreateButton = false;
        $this->showExportButton = true;
    }

    public function getRowActions($row): array
    {
        return [
            'delete' => [
                'action' => 'delete',
                'label' => 'Delete',
                'iconClass' => 'bx bx-trash',
                'btnClass' => 'text-danger',
                'enabled' => true,
            ]
        ];
    }
}
