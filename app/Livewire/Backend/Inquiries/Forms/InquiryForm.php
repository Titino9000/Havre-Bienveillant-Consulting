<?php

namespace App\Livewire\Backend\Inquiries\Forms;

use App\Livewire\Components\Forms\BaseForm;
use App\Models\Inquiry;

class InquiryForm extends BaseForm
{
    protected function getFields(): array
    {
        return [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'rules' => 'required|string'],
            ['name' => 'email', 'label' => 'Email', 'type' => 'text', 'rules' => 'required|email'],
            ['name' => 'phone', 'label' => 'Phone', 'type' => 'text', 'rules' => 'nullable|string'],
            ['name' => 'subject', 'label' => 'Subject', 'type' => 'text', 'rules' => 'nullable|string'],
            ['name' => 'message', 'label' => 'Message', 'type' => 'textarea', 'rules' => 'required|string'],
            ['name' => 'is_read', 'label' => 'Mark as Read', 'type' => 'checkbox', 'rules' => 'boolean']
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
        $record = Inquiry::find($id);
        if ($record) {
            $this->formData = $record->toArray();
        }
    }

    protected function saveData(): void
    {
        if ($this->isEditMode) {
            Inquiry::find($this->modelId)->update($this->formData);
        } else {
            Inquiry::create($this->formData);
        }
    }
}
