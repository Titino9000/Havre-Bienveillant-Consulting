<?php

namespace App\Livewire\Backend\Sliders\Forms;

use App\Livewire\Components\Forms\BaseForm;
use App\Models\Slider;

class SliderForm extends BaseForm
{
    public $image_path_file;

    protected function getFields(): array
    {
        return [
            ['name' => 'title.en', 'label' => 'Title (EN)', 'type' => 'text', 'rules' => 'nullable|string|max:255', 'group' => 'General'],
            ['name' => 'title.fr', 'label' => 'Title (FR)', 'type' => 'text', 'rules' => 'nullable|string|max:255', 'group' => 'General'],
            ['name' => 'subtitle.en', 'label' => 'Subtitle (EN)', 'type' => 'textarea', 'rules' => 'nullable|string', 'group' => 'General'],
            ['name' => 'subtitle.fr', 'label' => 'Subtitle (FR)', 'type' => 'textarea', 'rules' => 'nullable|string', 'group' => 'General'],
            ['name' => 'order', 'label' => 'Display Order', 'type' => 'number', 'rules' => 'required|integer', 'group' => 'Settings'],
            ['name' => 'image_path', 'label' => 'Slider Image', 'type' => 'file', 'group' => 'Settings'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'rules' => 'nullable|boolean', 'group' => 'Settings']
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
        $record = Slider::find($id);
        if ($record) {
            $this->formData = $record->toArray();
        }
    }

    protected function saveData(): void
    {
        if ($this->image_file) {
            $this->formData['image_path'] = $this->image_file->store('sliders', 'public');
        }

        // Checkbox defaults
        $this->formData['is_active'] = $this->formData['is_active'] ?? false;

        if ($this->isEditMode) {
            Slider::find($this->modelId)->update($this->formData);
        } else {
            Slider::create($this->formData);
        }
    }
}
