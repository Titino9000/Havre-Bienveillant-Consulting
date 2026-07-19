<?php

namespace App\Livewire\Backend\Team;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'Manage Team'])]
class TeamManager extends Component
{
    public function render()
    {
        return view('livewire.backend.team.team-manager');
    }
}
