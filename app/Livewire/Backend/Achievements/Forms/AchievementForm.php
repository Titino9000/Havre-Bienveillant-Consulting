<?php

namespace App\Livewire\Backend\Achievements\Forms;

use App\Livewire\Components\Forms\BaseForm;
use App\Models\Achievement;

class AchievementForm extends BaseForm
{
    public $image_file;

    protected function getFields(): array
    {
        return [
            ['name' => 'title_en', 'label' => 'Title (English)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ['name' => 'title_fr', 'label' => 'Title (French)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'options' => ['project' => 'Project', 'certification' => 'Certification', 'partner' => 'Partner/Client'], 'rules' => 'nullable|string'],
            ['name' => 'image', 'label' => 'Image', 'type' => 'file'],
            ['name' => 'description_en', 'label' => 'Description (EN)', 'type' => 'ckeditor', 'rules' => 'nullable|string'],
            ['name' => 'description_fr', 'label' => 'Description (FR)', 'type' => 'ckeditor', 'rules' => 'nullable|string']
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
        $record = Achievement::find($id);
        if ($record) {
            $this->formData = $record->toArray();
        }
    }

    protected function saveData(): void
    {
        if ($this->image_file) {
            $this->formData['image'] = $this->image_file->store('achievements', 'public');
        }

        if ($this->isEditMode) {
            Achievement::find($this->modelId)->update($this->formData);
        } else {
            Achievement::create($this->formData);
        }
    }
}
