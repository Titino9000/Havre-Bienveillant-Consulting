<?php

namespace App\Livewire\Backend\Sliders\Tables;

use App\Livewire\Components\Tables\BaseTable;
use App\Models\Slider;

class SlidersTable extends BaseTable
{
    public function mount(array $columns = [], string $modelClass = '', array $bulkActions = [], int $perPage = 10, string $context = '', string $buttonLabel = 'Create'): void
    {
        parent::mount(
            columns: [
                ['label' => 'Image', 'field' => 'image_path', 'type' => 'image', 'searchable' => false],
                ['label' => 'Title', 'field' => 'title', 'searchable' => true, 'sortable' => true],
                ['label' => 'Order', 'field' => 'order', 'searchable' => false, 'sortable' => true]
            ],
            modelClass: Slider::class,
            bulkActions: ['delete' => 'Delete Selected'],
            context: 'Slider',
            buttonLabel: 'Add Slider'
        );
        $this->formComponent = 'backend.sliders.forms.slider-form';
    }
}
