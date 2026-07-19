<?php

namespace App\Livewire\Backend\Roles\Tables;

use App\Livewire\Components\Tables\BaseTable;
use Spatie\Permission\Models\Role;

class RolesTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Name', 'field' => 'name', 'searchable' => true, 'sortable' => true],
                ['label' => 'Guard Name', 'field' => 'guard_name', 'type' => 'badge', 'badge_color' => ['web' => 'info', 'api' => 'primary'], 'searchable' => true, 'sortable' => true],
                ['label' => 'Created', 'field' => 'created_at', 'searchable' => false, 'sortable' => true]
            ],
            modelClass: Role::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'Role',
            buttonLabel: 'Add Role'
        );
        $this->formComponent = 'backend.roles.forms.role-form';
    }
}
