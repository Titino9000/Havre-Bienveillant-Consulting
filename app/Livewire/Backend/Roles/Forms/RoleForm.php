<?php

namespace App\Livewire\Backend\Roles\Forms;

use App\Livewire\Components\Forms\BaseForm;
use Spatie\Permission\Models\Role;

class RoleForm extends BaseForm
{
    protected function getFields(): array
    {
        $permissions = \Spatie\Permission\Models\Permission::pluck('name', 'name')->toArray();

        return [
            ['name' => 'name', 'label' => 'Role Name', 'type' => 'text', 'rules' => 'required|string|max:255|unique:roles,name,' . $this->modelId, 'group' => 'General'],
            ['name' => 'guard_name', 'label' => 'Guard Name', 'type' => 'text', 'rules' => 'required|string|max:255', 'default' => 'web', 'group' => 'General'],
            ['name' => 'permissions', 'label' => 'Permissions', 'type' => 'checkbox-group', 'options' => $permissions, 'options_col' => 4, 'group' => 'Permissions']
        ];
    }

    public function getRules(): array
    {
        $rules = [];
        foreach ($this->getFields() as $field) {
            if ($field['name'] === 'permissions') {
                $rules['formData.permissions'] = 'nullable|array';
                continue;
            }
            $rules['formData.' . $field['name']] = $field['rules'] ?? 'nullable';
        }
        return $rules;
    }

    protected function loadData($id): void
    {
        $record = Role::find($id);
        if ($record) {
            $this->formData = $record->toArray();
            $this->formData['permissions'] = $record->permissions->pluck('name')->toArray();
        }
    }

    protected function saveData(): void
    {
        $permissions = $this->formData['permissions'] ?? [];
        unset($this->formData['permissions']);

        if ($this->isEditMode) {
            $role = Role::find($this->modelId);
            $role->update($this->formData);
            $role->syncPermissions($permissions);
        } else {
            $role = Role::create($this->formData);
            $role->syncPermissions($permissions);
        }
    }
}
