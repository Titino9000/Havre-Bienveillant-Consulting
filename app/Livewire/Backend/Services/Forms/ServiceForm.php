<?php

namespace App\Livewire\Backend\Services\Forms;

use App\Livewire\Components\Forms\BaseForm;
use App\Models\Service;

class ServiceForm extends BaseForm
{
    public $image_file;

    protected function getFields(): array
    {
        return [
            ['name' => 'title.en', 'label' => 'Title (English)', 'type' => 'text', 'rules' => 'required|string|max:255'],
            ['name' => 'title.fr', 'label' => 'Title (French)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ['name' => 'subtitle.en', 'label' => 'Subtitle (English)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ['name' => 'subtitle.fr', 'label' => 'Subtitle (French)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'options' => ['counseling' => 'Counseling', 'workshop' => 'Workshop', 'consulting' => 'Consulting'], 'rules' => 'required|string'],
            ['name' => 'icon', 'label' => 'Icon Class', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ['name' => 'image', 'label' => 'Service Image', 'type' => 'file'],
            ['name' => 'description.en', 'label' => 'Overview (EN)', 'type' => 'ckeditor', 'rules' => 'required|string'],
            ['name' => 'description.fr', 'label' => 'Overview (FR)', 'type' => 'ckeditor', 'rules' => 'nullable|string'],
            ['name' => 'audiences.en', 'label' => 'Audiences/Who We Support (EN) - Line separated', 'type' => 'textarea', 'rules' => 'nullable|string'],
            ['name' => 'audiences.fr', 'label' => 'Audiences/Who We Support (FR) - Line separated', 'type' => 'textarea', 'rules' => 'nullable|string'],
            ['name' => 'features.en', 'label' => 'Features/Services Include (EN) - Line separated', 'type' => 'textarea', 'rules' => 'nullable|string'],
            ['name' => 'features.fr', 'label' => 'Features/Services Include (FR) - Line separated', 'type' => 'textarea', 'rules' => 'nullable|string'],
            ['name' => 'benefits.en', 'label' => 'Benefits/Expectations (EN) - Line separated', 'type' => 'textarea', 'rules' => 'nullable|string'],
            ['name' => 'benefits.fr', 'label' => 'Benefits/Expectations (FR) - Line separated', 'type' => 'textarea', 'rules' => 'nullable|string'],
            ['name' => 'cta_text.en', 'label' => 'CTA Text (English)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ['name' => 'cta_text.fr', 'label' => 'CTA Text (French)', 'type' => 'text', 'rules' => 'nullable|string|max:255']
        ];
    }

    protected function getFileRules(): array
    {
        return [
            'image_file' => 'nullable|image|max:2048'
        ];
    }

    public function getRules(): array
    {
        $rules = [];
        foreach ($this->getFields() as $field) {
            if ($field['type'] !== 'file') {
                $rules['formData.' . $field['name']] = $field['rules'] ?? 'nullable';
            }
        }
        return $rules;
    }

    protected function loadData($id): void
    {
        $record = Service::find($id);
        if ($record) {
            $this->formData = $record->toArray();
        }
    }

    protected function saveData(): void
    {
        if ($this->image_file) {
            $this->formData['image'] = $this->image_file->store('services', 'public');
        }

        if ($this->isEditMode) {
            Service::find($this->modelId)->update($this->formData);
        } else {
            Service::create($this->formData);
        }
    }
}
