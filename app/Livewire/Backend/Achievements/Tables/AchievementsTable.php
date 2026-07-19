<?php

namespace App\Livewire\Backend\Achievements\Tables;

use App\Livewire\Components\Tables\BaseTable;
use App\Models\Achievement;

class AchievementsTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Image', 'field' => 'image', 'type' => 'image', 'searchable' => false],
                ['label' => 'Title', 'field' => 'title_en', 'searchable' => true, 'sortable' => true],
                ['label' => 'Type', 'field' => 'type', 'searchable' => true, 'sortable' => true]
            ],
            modelClass: Achievement::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'Achievements',
            buttonLabel: 'Add Record'
        );
        $this->formComponent = 'backend.achievements.forms.achievement-form';
    }
}
