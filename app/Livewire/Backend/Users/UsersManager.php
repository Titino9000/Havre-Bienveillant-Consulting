<?php

namespace App\Livewire\Backend\Users;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'Manage Users'])]
class UsersManager extends Component
{
    public function render()
    {
        return view('livewire.backend.users.users-manager');
    }
}
