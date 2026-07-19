<?php

namespace App\Livewire\Backend\KnowledgeHub;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'Manage Knowledge Hub'])]
class KnowledgeHubManager extends Component
{
    public function render()
    {
        return view('livewire.backend.knowledge-hub.knowledge-hub-manager');
    }
}
