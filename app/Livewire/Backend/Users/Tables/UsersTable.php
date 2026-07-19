<?php

namespace App\Livewire\Backend\Users\Tables;

use App\Livewire\Components\Tables\BaseTable;
use App\Models\User;

class UsersTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Name', 'field' => 'name', 'searchable' => true, 'sortable' => true],
                ['label' => 'Email', 'field' => 'email', 'searchable' => true, 'sortable' => true],
                ['label' => 'Admin', 'field' => 'is_admin', 'type' => 'badge', 'badge_color' => [1 => 'primary', 0 => 'secondary'], 'searchable' => false, 'sortable' => true],
                ['label' => 'Created', 'field' => 'created_at', 'searchable' => false, 'sortable' => true]
            ],
            modelClass: User::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'User',
            buttonLabel: 'Add User'
        );
        $this->formComponent = 'backend.users.forms.user-form';
    }
}
