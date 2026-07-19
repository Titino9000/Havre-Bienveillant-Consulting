<?php

namespace App\Livewire\Backend\KnowledgeHub\Tables;

use App\Livewire\Components\Tables\BaseTable;
use App\Models\KnowledgeHub;

class KnowledgeHubTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Thumbnail', 'field' => 'image_path', 'type' => 'image', 'searchable' => false],
                ['label' => 'Title', 'field' => 'title', 'searchable' => true, 'sortable' => true, 'searchFields' => ['title']],
                ['label' => 'Type', 'field' => 'type', 'searchable' => true, 'sortable' => true],
                ['label' => 'Active', 'field' => 'is_active', 'type' => 'badge', 'badge_color' => [1 => 'success', 0 => 'secondary'], 'searchable' => false, 'sortable' => true]
            ],
            modelClass: KnowledgeHub::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'Knowledge Hub',
            buttonLabel: 'Add Resource'
        );
        $this->formComponent = 'backend.knowledge-hub.forms.knowledge-hub-form';
    }
}
