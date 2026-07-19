<?php

namespace App\Livewire\Backend\Faq\Forms;

use App\Livewire\Components\Forms\BaseForm;
use App\Models\Faq;

class FaqForm extends BaseForm
{
    protected function getFields(): array
    {
        return [
            ['name' => 'question.en', 'label' => 'Question (EN)', 'type' => 'text', 'rules' => 'required|string|max:255', 'group' => 'General'],
            ['name' => 'question.fr', 'label' => 'Question (FR)', 'type' => 'text', 'rules' => 'nullable|string|max:255', 'group' => 'General'],
            ['name' => 'answer.en', 'label' => 'Answer (EN)', 'type' => 'ckeditor', 'rules' => 'required|string', 'group' => 'General'],
            ['name' => 'answer.fr', 'label' => 'Answer (FR)', 'type' => 'ckeditor', 'rules' => 'nullable|string', 'group' => 'General'],
            ['name' => 'order', 'label' => 'Display Order', 'type' => 'number', 'rules' => 'required|integer', 'group' => 'Settings'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'rules' => 'nullable|boolean', 'group' => 'Settings']
        ];
    }

    public function getRules(): array
    {
        $rules = [];
        foreach ($this->getFields() as $field) {
            $rules['formData.' . $field['name']] = $field['rules'] ?? 'nullable';
        }
        return $rules;
    }

    protected function loadData($id): void
    {
        $record = Faq::find($id);
        if ($record) {
            $this->formData = $record->toArray();
        }
    }

    protected function saveData(): void
    {
        $this->formData['is_active'] = $this->formData['is_active'] ?? false;

        if ($this->isEditMode) {
            Faq::find($this->modelId)->update($this->formData);
        } else {
            Faq::create($this->formData);
        }
    }
}
