<?php

namespace App\Livewire\Backend\Roles;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'Manage Roles'])]
class RolesManager extends Component
{
    public function render()
    {
        return view('livewire.backend.roles.roles-manager');
    }
}
