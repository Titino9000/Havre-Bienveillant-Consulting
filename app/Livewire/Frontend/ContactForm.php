<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Inquiry;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;
    public $successMessage = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ];

    public function submit()
    {
        $validatedData = $this->validate();

        Inquiry::create($validatedData);

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
        $this->successMessage = 'Votre message a été envoyé avec succès. Nous vous contacterons sous peu.';
    }

    public function render()
    {
        return view('components.frontend.contact-form');
    }
}
