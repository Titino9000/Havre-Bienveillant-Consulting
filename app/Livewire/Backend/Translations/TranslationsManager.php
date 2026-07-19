<?php

namespace App\Livewire\Backend\Translations;

use Livewire\Component;
use Illuminate\Support\Facades\File;

class TranslationsManager extends Component
{
    public $search = '';
    public $translations = [];
    
    public $editingKey = '';
    public $editingEn = '';
    public $editingFr = '';

    public $newKey = '';
    public $newEn = '';
    public $newFr = '';

    public function mount()
    {
        $this->loadTranslations();
    }

    public function loadTranslations()
    {
        $enPath = base_path('lang/en.json');
        $frPath = base_path('lang/fr.json');

        $enData = File::exists($enPath) ? json_decode(File::get($enPath), true) : [];
        $frData = File::exists($frPath) ? json_decode(File::get($frPath), true) : [];

        $allKeys = array_unique(array_merge(array_keys($enData), array_keys($frData)));
        
        $this->translations = [];
        foreach ($allKeys as $key) {
            $this->translations[$key] = [
                'en' => $enData[$key] ?? $key,
                'fr' => $frData[$key] ?? ''
            ];
        }
    }

    public function edit($key)
    {
        $this->editingKey = $key;
        $this->editingEn = $this->translations[$key]['en'] ?? $key;
        $this->editingFr = $this->translations[$key]['fr'] ?? '';
    }

    public function saveEdit()
    {
        $this->validate([
            'editingKey' => 'required',
            'editingEn' => 'required',
            'editingFr' => 'required',
        ]);

        $this->saveTranslation($this->editingKey, $this->editingEn, $this->editingFr);
        
        $this->editingKey = '';
        $this->dispatch('close-modal');
        $this->dispatch('notify', ['message' => 'Translation updated successfully!', 'type' => 'success']);
    }

    public function saveNew()
    {
        $this->validate([
            'newKey' => 'required',
            'newEn' => 'required',
            'newFr' => 'required',
        ]);

        $this->saveTranslation($this->newKey, $this->newEn, $this->newFr);
        
        $this->newKey = '';
        $this->newEn = '';
        $this->newFr = '';
        
        $this->dispatch('close-modal');
        $this->dispatch('notify', ['message' => 'Translation added successfully!', 'type' => 'success']);
    }
    
    public function delete($key)
    {
        $enPath = base_path('lang/en.json');
        $frPath = base_path('lang/fr.json');

        $enData = File::exists($enPath) ? json_decode(File::get($enPath), true) : [];
        $frData = File::exists($frPath) ? json_decode(File::get($frPath), true) : [];

        unset($enData[$key]);
        unset($frData[$key]);

        File::put($enPath, json_encode($enData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        File::put($frPath, json_encode($frData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->loadTranslations();
        $this->dispatch('notify', ['message' => 'Translation deleted!', 'type' => 'success']);
    }

    private function saveTranslation($key, $en, $fr)
    {
        $enPath = base_path('lang/en.json');
        $frPath = base_path('lang/fr.json');

        $enData = File::exists($enPath) ? json_decode(File::get($enPath), true) : [];
        $frData = File::exists($frPath) ? json_decode(File::get($frPath), true) : [];

        $enData[$key] = $en;
        $frData[$key] = $fr;

        File::put($enPath, json_encode($enData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        File::put($frPath, json_encode($frData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->loadTranslations();
    }

    public function render()
    {
        $filtered = collect($this->translations)->filter(function ($value, $key) {
            if (empty($this->search)) return true;
            $search = strtolower($this->search);
            return str_contains(strtolower($key), $search) || 
                   str_contains(strtolower($value['en']), $search) || 
                   str_contains(strtolower($value['fr']), $search);
        });

        return view('livewire.backend.translations.translations-manager', [
            'filteredTranslations' => $filtered
        ])->layout('components.backend.layouts.back-master');
    }
}
