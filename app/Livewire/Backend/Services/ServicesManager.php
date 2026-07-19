<?php

namespace App\Livewire\Backend\Services;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'Manage Services'])]
class ServicesManager extends Component
{
    public function render()
    {
        return view('livewire.backend.services.services-manager');
    }
}
