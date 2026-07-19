<?php

namespace App\Livewire\Backend\Permissions\Tables;

use App\Livewire\Components\Tables\BaseTable;
use Spatie\Permission\Models\Permission;

class PermissionsTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Name', 'field' => 'name', 'searchable' => true, 'sortable' => true],
                ['label' => 'Guard Name', 'field' => 'guard_name', 'type' => 'badge', 'badge_color' => ['web' => 'info', 'api' => 'primary'], 'searchable' => true, 'sortable' => true],
                ['label' => 'Created', 'field' => 'created_at', 'searchable' => false, 'sortable' => true]
            ],
            modelClass: Permission::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'Permission',
            buttonLabel: 'Add Permission'
        );
        $this->formComponent = 'backend.permissions.forms.permission-form';
    }
}
