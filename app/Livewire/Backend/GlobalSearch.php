<?php

namespace App\Livewire\Backend;

use App\Models\Service;
use App\Models\TeamMember;
use App\Models\KnowledgeHub;
use App\Models\Faq;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $query = '';

    public function render()
    {
        $results = collect();

        if (strlen($this->query) >= 2) {
            $services = Service::where('title', 'like', '%' . $this->query . '%')
                ->orWhere('description', 'like', '%' . $this->query . '%')
                ->get()->map(function($item) {
                    return ['title' => $item->title, 'type' => 'Services', 'icon' => 'bx-briefcase', 'url' => route('admin.services') . '?search=' . urlencode($this->query)];
                });

            $team = TeamMember::where('name', 'like', '%' . $this->query . '%')
                ->orWhere('position', 'like', '%' . $this->query . '%')
                ->get()->map(function($item) {
                    return ['title' => $item->name, 'type' => 'Team', 'icon' => 'bx-user', 'url' => route('admin.team') . '?search=' . urlencode($this->query)];
                });

            $knowledge = KnowledgeHub::where('title', 'like', '%' . $this->query . '%')
                ->orWhere('content', 'like', '%' . $this->query . '%')
                ->get()->map(function($item) {
                    return ['title' => $item->title, 'type' => 'Knowledge Hub', 'icon' => 'bx-book-content', 'url' => route('admin.knowledge_hub') . '?search=' . urlencode($this->query)];
                });

            $faqs = Faq::where('question', 'like', '%' . $this->query . '%')
                ->orWhere('answer', 'like', '%' . $this->query . '%')
                ->get()->map(function($item) {
                    return ['title' => $item->question, 'type' => 'FAQs', 'icon' => 'bx-help-circle', 'url' => route('admin.faqs') . '?search=' . urlencode($this->query)];
                });

            $results = $results->merge($services)->merge($team)->merge($knowledge)->merge($faqs);
        }

        return view('livewire.backend.global-search', [
            'results' => $results->groupBy('type')
        ]);
    }
}
