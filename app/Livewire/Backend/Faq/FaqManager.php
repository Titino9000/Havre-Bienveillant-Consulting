<?php

namespace App\Livewire\Backend\Faq;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'Manage FAQs'])]
class FaqManager extends Component
{
    public function render()
    {
        return view('livewire.backend.faq.faq-manager');
    }
}
