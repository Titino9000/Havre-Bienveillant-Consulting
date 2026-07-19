<?php

namespace App\Livewire\Backend\Permissions;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'Manage Permissions'])]
class PermissionsManager extends Component
{
    public function render()
    {
        return view('livewire.backend.permissions.permissions-manager');
    }
}
