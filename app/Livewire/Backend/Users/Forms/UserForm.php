<?php

namespace App\Livewire\Backend\Users\Forms;

use App\Livewire\Components\Forms\BaseForm;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserForm extends BaseForm
{
    protected function getFields(): array
    {
        $roles = \Spatie\Permission\Models\Role::pluck('name', 'name')->toArray();

        return [
            ['name' => 'name', 'label' => 'Full Name', 'type' => 'text', 'rules' => 'required|string|max:255', 'group' => 'Personal Info'],
            ['name' => 'email', 'label' => 'Email Address', 'type' => 'email', 'rules' => 'required|email|unique:users,email,' . $this->modelId, 'group' => 'Personal Info'],
            ['name' => 'password', 'label' => 'Password (leave blank to keep current)', 'type' => 'password', 'rules' => $this->isEditMode ? 'nullable|min:8' : 'required|min:8', 'group' => 'Security'],
            ['name' => 'roles', 'label' => 'Roles', 'type' => 'checkbox-group', 'options' => $roles, 'options_col' => 6, 'group' => 'Security']
        ];
    }

    public function getRules(): array
    {
        $rules = [];
        foreach ($this->getFields() as $field) {
            if ($field['name'] === 'roles') {
                $rules['formData.roles'] = 'nullable|array';
                continue;
            }
            $rules['formData.' . $field['name']] = $field['rules'] ?? 'nullable';
        }
        return $rules;
    }

    protected function loadData($id): void
    {
        $record = User::find($id);
        if ($record) {
            $data = $record->toArray();
            unset($data['password']); // Never load password
            $data['roles'] = $record->roles->pluck('name')->toArray();
            $this->formData = $data;
        }
    }

    protected function saveData(): void
    {
        $data = $this->formData;
        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($this->isEditMode) {
            $user = User::find($this->modelId);
            $user->update($data);
            $user->syncRoles($roles);
        } else {
            $user = User::create($data);
            $user->syncRoles($roles);
        }
    }
}
