<?php

namespace App\Livewire\Backend\Achievements;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'Manage Achievements'])]
class AchievementsManager extends Component
{
    public function render()
    {
        return view('livewire.backend.achievements.achievements-manager');
    }
}
