<?php

namespace App\Livewire\Backend\Inquiries;

use Livewire\Component;

class InquiriesManager extends Component
{
    public function render()
    {
        return view('components.backend.inquiries.inquiries-manager')
            ->layout('components.backend.layouts.back-master', ['title' => 'Manage Inquiries']);
    }
}
