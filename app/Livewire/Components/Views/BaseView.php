<?php

namespace App\Livewire\Components\Views;

use Livewire\Component;
use Livewire\Attributes\On;

class BaseView extends Component
{
    public bool $viewingItem = false;
    public array $viewItemData = [];
    public string $viewItemTitle = 'Record Details';

    #[On('openViewModal')]
    public function openModal(array $data, string $title = 'Record Details'): void
    {
        $this->viewItemData = $data;
        $this->viewItemTitle = $title;
        $this->viewingItem = true;
    }

    public function closeViewModal(): void
    {
        $this->viewingItem = false;
        $this->viewItemData = [];
    }

    public function render()
    {
        return view('livewire.components.views.base-view');
    }
}
