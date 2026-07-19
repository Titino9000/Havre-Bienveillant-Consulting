<?php

namespace App\Livewire\Backend\KnowledgeHub\Forms;

use App\Livewire\Components\Forms\BaseForm;
use App\Models\KnowledgeHub;

class KnowledgeHubForm extends BaseForm
{
    public $image_path_file;
    public $document_file_file;

    protected function getFields(): array
    {
        return [
            ['name' => 'title.en', 'label' => 'Title (EN)', 'type' => 'text', 'rules' => 'required|string|max:255', 'group' => 'General'],
            ['name' => 'title.fr', 'label' => 'Title (FR)', 'type' => 'text', 'rules' => 'nullable|string|max:255', 'group' => 'General'],
            ['name' => 'content.en', 'label' => 'Content/Summary (EN)', 'type' => 'ckeditor', 'rules' => 'nullable|string', 'group' => 'General'],
            ['name' => 'content.fr', 'label' => 'Content/Summary (FR)', 'type' => 'ckeditor', 'rules' => 'nullable|string', 'group' => 'General'],
            ['name' => 'type', 'label' => 'Resource Type', 'type' => 'select', 'options' => ['article' => 'Article', 'pdf' => 'PDF Download', 'video' => 'Video'], 'rules' => 'required|string', 'group' => 'Settings'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'rules' => 'nullable|boolean', 'group' => 'Settings'],
            ['name' => 'image_path', 'label' => 'Thumbnail Image', 'type' => 'file', 'group' => 'Media'],
            ['name' => 'document_file', 'label' => 'PDF Document / Video URL', 'type' => 'file', 'group' => 'Media']
        ];
    }

    protected function getFileRules(): array
    {
        return [
            'image_path_file' => 'nullable|image|max:2048',
            'document_file_file' => 'nullable|mimes:pdf|max:10240' // 10MB limit for PDFs
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
        $record = KnowledgeHub::find($id);
        if ($record) {
            $this->formData = $record->toArray();
        }
    }

    protected function saveData(): void
    {
        if ($this->image_path_file) {
            $this->formData['image_path'] = $this->image_path_file->store('knowledge_hub/thumbnails', 'public');
        }
        if ($this->document_file_file) {
            $this->formData['file_path'] = $this->document_file_file->store('knowledge_hub/documents', 'public');
        }

        $this->formData['is_active'] = $this->formData['is_active'] ?? false;

        if ($this->isEditMode) {
            KnowledgeHub::find($this->modelId)->update($this->formData);
        } else {
            KnowledgeHub::create($this->formData);
        }
    }
}
