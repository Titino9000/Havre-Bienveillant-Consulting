<?php

namespace App\Livewire\Backend\Permissions\Forms;

use App\Livewire\Components\Forms\BaseForm;
use Spatie\Permission\Models\Permission;

class PermissionForm extends BaseForm
{
    protected function getFields(): array
    {
        return [
            ['name' => 'name', 'label' => 'Permission Name (e.g. manage_users)', 'type' => 'text', 'rules' => 'required|string|max:255', 'group' => 'General'],
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
        $record = Permission::find($id);
        if ($record) {
            $this->formData = $record->toArray();
        }
    }

    protected function saveData(): void
    {
        // Spatie requires 'guard_name' normally, but it defaults to 'web'.
        $this->formData['guard_name'] = 'web';

        if ($this->isEditMode) {
            Permission::find($this->modelId)->update($this->formData);
        } else {
            Permission::create($this->formData);
        }
    }
}
