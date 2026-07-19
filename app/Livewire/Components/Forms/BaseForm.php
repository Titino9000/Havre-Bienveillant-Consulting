<?php

namespace App\Livewire\Components\Forms;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

abstract class BaseForm extends Component
{
    use WithFileUploads;

    public bool $isOpen = false;
    public bool $isEditMode = false;
    public $modelId = null;
    public string $formTitle = '';
    public string $submitButtonText = 'Save';
    public string $cancelButtonText = 'Cancel';
    public string $formSize = 'lg';
    public bool $isLoading = false;
    public array $formData = [];

    protected array $fileFields = [];
    public bool $showCredentialsModal = false;
    public string $newlyCreatedKey = '';
    public string $newlyCreatedSecret = '';

    // PWA Offline Sync Support
    public bool $supportsOffline = false;
    public string $offlineEndpoint = '';

    // Listeners are now defined via #[On] attributes

    /** ----------------------------------------------------------------------------------------------------------------
     * Return additional validation rules for file upload fields.
     * Override in child classes to add file-specific rules (e.g., 'file' => 'image|max:1024').
     * -------------------------------------------------------------------------------------------------------------- */
    protected function getFileRules(): array
    {
        return [];
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Open the modal in "create" mode. Resets the form, sets title/button text, and clears modelId.
     * -------------------------------------------------------------------------------------------------------------- */
    #[On('openCreateForm')]
    public function open()
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->formTitle = $this->getCreateTitle();
        $this->submitButtonText = 'Create';
        $this->modelId = null;
        $this->isOpen = true;
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Open the modal in "edit" mode for a given record ID. Loads existing data, sets title/button text.
     * -------------------------------------------------------------------------------------------------------------- */
    #[On('editForm')]
    public function edit($id)
    {
        $this->resetForm();
        $this->isEditMode = true;
        $this->formTitle = $this->getEditTitle();
        $this->submitButtonText = 'Update';
        $this->modelId = $id;
        $this->loadData($id);
        $this->isOpen = true;
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Close the modal and reset all form state (data, validation, file fields, etc.).
     * -------------------------------------------------------------------------------------------------------------- */
    public function close()
    {
        $this->isOpen = false;
        $this->resetForm();
        $this->resetValidation();
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Close the credentials modal (used after creating API keys or similar) and clear its data.
     * -------------------------------------------------------------------------------------------------------------- */
    public function closeCredentialsModal()
    {
        $this->showCredentialsModal = false;
        $this->newlyCreatedKey = '';
        $this->newlyCreatedSecret = '';
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Validate the form, save the data (create or update), dispatch events, and close the modal.
     * Handles loading state, exceptions, and optional credentials modal display.
     * -------------------------------------------------------------------------------------------------------------- */
    public function save()
    {
        try {
            // Merge file rules with regular rules
            $rules = array_merge($this->getRules(), $this->getFileRules());
            $this->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('toast', message: 'Please correct the highlighted errors before saving.', type: 'warning');
            throw $e;
        }

        $this->isLoading = true;

        try {
            $this->saveData();
            $message = $this->getSuccessMessage();
            $this->dispatch('formSaved', message: $message);

            if (!$this->showCredentialsModal) {
                $this->close();
            } else {
                $this->isOpen = false;
            }

            $this->dispatch('refreshTable');
        } catch (\Exception $e) {
            $this->addError('form', $e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Reset the entire form state: clear formData, IDs, error bag, file fields, and reinitialize fields from getFields().
     * -------------------------------------------------------------------------------------------------------------- */
    protected function resetForm()
    {
        // Reset regular form data
        $this->formData = [];
        $this->modelId = null;
        $this->isEditMode = false;
        $this->showCredentialsModal = false;
        $this->newlyCreatedKey = '';
        $this->newlyCreatedSecret = '';
        $this->resetErrorBag();

        // Reset file fields to null
        foreach ($this->fileFields as $fieldName) {
            $this->$fieldName = null;
        }
        $this->fileFields = [];

        // Process field definitions
        foreach ($this->getFields() as $field) {
            $name = $field['name'];
            $type = $field['type'] ?? 'text';

            if ($type === 'file') {
                // Register file field – we'll create a public property automatically
                $propertyName = $name . '_file';
                $this->fileFields[] = $propertyName;
                if (!property_exists($this, $propertyName)) {
                    $this->$propertyName = null;
                }
                // Do NOT add to formData
                continue;
            }

            if ($type === 'checkbox-group' || $type === 'schema_builder') {
                $this->formData[$name] = $field['default'] ?? [];
            } elseif ($type === 'checkbox') {
                $this->formData[$name] = $field['default'] ?? false;
            } else {
                $this->formData[$name] = $field['default'] ?? '';
            }
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Handle checkbox‑group toggle: add or remove a value from the array stored in formData.
     * Used by the Blade view when a checkbox inside a group is clicked.
     * -------------------------------------------------------------------------------------------------------------- */
    public function updateCheckboxGroup($fieldName, $value, $checked)
    {
        if (!isset($this->formData[$fieldName]) || !is_array($this->formData[$fieldName])) {
            $this->formData[$fieldName] = [];
        }

        $currentValues = $this->formData[$fieldName];

        if ($checked) {
            if (!in_array($value, $currentValues)) {
                $currentValues[] = $value;
            }
        } else {
            $currentValues = array_values(array_diff($currentValues, [$value]));
        }

        $this->formData[$fieldName] = $currentValues;
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Helper to return the dynamic property name used for a file upload field.
     * -------------------------------------------------------------------------------------------------------------- */
    protected function getFilePropertyName(string $fieldName): string
    {
        return $fieldName . '_file';
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Return the modal title for create mode. Override in child classes.
     * -------------------------------------------------------------------------------------------------------------- */
    protected function getCreateTitle(): string
    {
        return 'Create New Record';
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Return the modal title for edit mode. Override in child classes.
     * -------------------------------------------------------------------------------------------------------------- */
    protected function getEditTitle(): string
    {
        return 'Edit Record';
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Return the success message after save. Override in child classes.
     * -------------------------------------------------------------------------------------------------------------- */
    protected function getSuccessMessage(): string
    {
        return $this->isEditMode ? 'Record updated!' : 'Record created!';
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Define validation rules for the form. Override in child classes.
     * -------------------------------------------------------------------------------------------------------------- */
    public function getRules(): array
    {
        return [];
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Dynamically map validation attributes to their human-readable labels based on getFields().
     * This prevents errors like "The formData.start_time field is required" and instead
     * displays "The Start Time field is required."
     * -------------------------------------------------------------------------------------------------------------- */
    public function validationAttributes(): array
    {
        $attributes = [];
        
        foreach ($this->getFields() as $field) {
            if (isset($field['name']) && isset($field['label'])) {
                $attributes['formData.' . $field['name']] = strtolower($field['label']);
            }
        }

        foreach ($this->fileFields as $fileField) {
            $originalName = str_replace('_file', '', $fileField);
            $label = collect($this->getFields())->firstWhere('name', $originalName)['label'] ?? $originalName;
            $attributes[$fileField] = strtolower($label);
        }

        return $attributes;
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Define the field structure (label, type, options, etc.) for the form. Override in child classes.
     * -------------------------------------------------------------------------------------------------------------- */
    protected function getFields(): array
    {
        return [];
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Perform the actual create/update database operation. Override in child classes.
     * -------------------------------------------------------------------------------------------------------------- */
    protected function saveData(): void
    {
        // child implements
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Load existing record data into $formData when editing. Override in child classes.
     * -------------------------------------------------------------------------------------------------------------- */
    protected function loadData($id): void
    {
        // child implements
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Render the Livewire view, grouping fields by their 'group' key and passing all necessary data to the Blade template.
     * -------------------------------------------------------------------------------------------------------------- */
    public function render()
    {
        $fields = $this->getFields();

        // Group fields by group name
        $groupedFields = [];
        foreach ($fields as $field) {
            $group = $field['group'] ?? 'General';
            if (!isset($groupedFields[$group])) {
                $groupedFields[$group] = [];
            }
            $groupedFields[$group][] = $field;
        }

        return view('livewire.components.forms.base-form', [
            'groupedFields' => $groupedFields,
            'formData' => $this->formData,
            'isOpen' => $this->isOpen,
            'isEditMode' => $this->isEditMode,
            'formTitle' => $this->formTitle,
            'submitButtonText' => $this->submitButtonText,
            'cancelButtonText' => $this->cancelButtonText,
            'formSize' => $this->formSize,
            'isLoading' => $this->isLoading,
            'showCredentialsModal' => $this->showCredentialsModal,
            'newlyCreatedKey' => $this->newlyCreatedKey,
            'newlyCreatedSecret' => $this->newlyCreatedSecret,
            'fileFields' => $this->fileFields,
            'supportsOffline' => $this->supportsOffline,
            'offlineEndpoint' => $this->offlineEndpoint,
        ]);
    }
}
