<?php

namespace App\Livewire\Backend\Team\Tables;

use App\Livewire\Components\Tables\BaseTable;
use App\Models\TeamMember;

class TeamMembersTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Image', 'field' => 'image', 'type' => 'image', 'searchable' => false],
                ['label' => 'Name', 'field' => 'name', 'searchable' => true, 'sortable' => true],
                ['label' => 'Role (EN)', 'field' => 'role_en', 'searchable' => true, 'sortable' => true],
                ['label' => 'Order', 'field' => 'order', 'searchable' => false, 'sortable' => true]
            ],
            modelClass: TeamMember::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'Team',
            buttonLabel: 'Add Record'
        );
        $this->formComponent = 'backend.team.forms.team-member-form';
    }
}
