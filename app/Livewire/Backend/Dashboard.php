<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Achievement;
use App\Models\Inquiry;

class Dashboard extends Component
{
    public function render()
    {
        return view('components.backend.dashboard', [
            'totalServices' => Service::count(),
            'totalTeamMembers' => TeamMember::count(),
            'totalAchievements' => Achievement::count(),
            'unreadInquiries' => Inquiry::where('is_read', false)->count(),
            'recentInquiries' => Inquiry::latest()->take(5)->get(),
            'teamMembersList' => TeamMember::latest()->take(5)->get(),
        ])->layout('components.backend.layouts.back-master', ['title' => 'Dashboard']);
    }
}
