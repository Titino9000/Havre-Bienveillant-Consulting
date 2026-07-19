<?php

namespace App\Livewire\Backend\Team\Forms;

use App\Livewire\Components\Forms\BaseForm;
use App\Models\TeamMember;

class TeamMemberForm extends BaseForm
{
    public $image_file;

    protected function getFields(): array
    {
        return [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'rules' => 'required|string|max:255'],
            ['name' => 'role_en', 'label' => 'Role (English)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ['name' => 'role_fr', 'label' => 'Role (French)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ['name' => 'order', 'label' => 'Display Order', 'type' => 'number', 'rules' => 'required|integer'],
            ['name' => 'bio_en', 'label' => 'Bio (EN)', 'type' => 'ckeditor', 'rules' => 'nullable|string'],
            ['name' => 'bio_fr', 'label' => 'Bio (FR)', 'type' => 'ckeditor', 'rules' => 'nullable|string'],
            ['name' => 'image', 'label' => 'Image', 'type' => 'file']
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
        $record = TeamMember::find($id);
        if ($record) {
            $this->formData = $record->toArray();
        }
    }

    protected function saveData(): void
    {
        if ($this->image_file) {
            $this->formData['image'] = $this->image_file->store('team', 'public');
        }

        if ($this->isEditMode) {
            TeamMember::find($this->modelId)->update($this->formData);
        } else {
            TeamMember::create($this->formData);
        }
    }
}
