<?php

namespace App\Livewire\Backend\Sliders;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'Manage Sliders'])]
class SlidersManager extends Component
{
    public function render()
    {
        return view('livewire.backend.sliders.sliders-manager');
    }
}
