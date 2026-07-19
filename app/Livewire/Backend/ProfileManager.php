<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;

#[Layout('components.backend.layouts.back-master', ['title' => 'My Profile'])]
class ProfileManager extends Component
{
    public $name;
    public $email;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.backend.profile-manager');
    }

    public function updateProfile()
    {
        $user = auth()->user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->forceFill([
            'name' => $this->name,
            'email' => $this->email,
        ])->save();

        $this->dispatch('swal:success', title: 'Updated', text: 'Profile information updated successfully.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->dispatch('swal:success', title: 'Updated', text: 'Password updated successfully.');
    }
}
