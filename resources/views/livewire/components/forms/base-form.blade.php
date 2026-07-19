{{-- resources/views/livewire/includes/forms/base-form.blade.php --}}
<div>
    @if($isOpen)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);" x-data="{ open: true }" x-show="open" x-cloak>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-{{ $formSize }}">
                <form class="modal-content"
                        @if($supportsOffline)
                            x-data="{
                                async submitOffline(e) {
                                    if (!navigator.onLine) {
                                        e.preventDefault();
                                        const data = @this.get('formData');
                                        
                                        if (window.VChurchSyncEngine) {
                                            await window.VChurchSyncEngine.queueAction(
                                                '{{ $offlineEndpoint }}',
                                                'POST',
                                                data
                                            );
                                            @this.call('close');
                                            window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'You are offline. Request saved locally and will sync when reconnected.', type: 'info' }}));
                                        }
                                        return false;
                                    } else {
                                        @this.call('save');
                                    }
                                }
                            }"
                            @submit.prevent="submitOffline($event)"
                        @else
                            wire:submit.prevent="save"
                        @endif
                        enctype="multipart/form-data">
                    <div class="modal-header bg-light p-4 border-bottom">
                        <h5 class="modal-title fw-bold mb-0 text-dark">{{ $formTitle }}</h5>
                        <button type="button" class="btn-close" wire:click="close" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">

                            <div wire:loading wire:target="edit, open" class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-muted">Loading form data...</p>
                            </div>


                            <div wire:loading.remove wire:target="edit, open, save">
                                @error('form')
                                    <div class="alert alert-danger mb-3">
                                        <i class="bx bx-error-circle me-2"></i>{{ $message }}
                                    </div>
                                @enderror

                                @foreach($groupedFields as $groupName => $fields)
                                    @if($groupName !== 'General')
                                        <div class="mt-4 mb-3 pb-1 border-bottom">
                                            <h6 class="text-primary fw-semibold">{{ $groupName }}</h6>
                                        </div>
                                    @endif

                                    <div class="row g-3">
                                        @foreach($fields as $field)
                                            @php
                                                $fieldName = $field['name'];
                                                $fieldValue = $formData[$fieldName] ?? '';
                                                $isCreateOnly = $field['createOnly'] ?? false;
                                                $showInEdit = $field['editOnly'] ?? false;
                                                $isReadonly = $field['readonly'] ?? false;
                                                $fieldType = $field['type'] ?? 'text';

                                                // Determine if field should be hidden
                                                if($isEditMode && $isCreateOnly) continue;
                                                if(!$isEditMode && $showInEdit) continue;

                                                // Bilingual layout detection
                                                $isEn = str_ends_with($fieldName, '.en') || str_ends_with($fieldName, '_en');
                                                $isFr = str_ends_with($fieldName, '.fr') || str_ends_with($fieldName, '_fr');
                                                $defaultCol = ($isEn || $isFr) ? 6 : 12;
                                                $colSize = $field['col'] ?? $defaultCol;

                                                // Styling
                                                $wrapperClass = '';
                                                $wrapperStyle = '';
                                                $langBadge = '';
                                                if ($isEn) {
                                                    $wrapperClass = 'p-3 rounded border h-100';
                                                    $langBadge = '<span class="badge bg-label-secondary ms-2" style="font-size: 0.65rem;">EN</span>';
                                                } elseif ($isFr) {
                                                    $wrapperClass = 'p-3 rounded border h-100';
                                                    $wrapperStyle = 'background-color: #f8e7c9; border-color: #e6d0a7 !important;';
                                                    $langBadge = '<span class="badge ms-2" style="background-color: #d4a373; font-size: 0.65rem;">FR</span>';
                                                }
                                            @endphp

                                            <div class="col-md-{{ $colSize }}" wire:key="field-{{ $fieldName }}">
                                                <div class="{{ $wrapperClass }}" style="{{ $wrapperStyle }}">
                                                    <label class="form-label fw-semibold d-flex align-items-center mb-2">
                                                        {{ $field['label'] }} {!! $langBadge !!}
                                                        @if(!empty($field['required']) && !$isReadonly)
                                                            <span class="text-danger ms-1">*</span>
                                                        @endif
                                                    </label>

                                                    @switch($fieldType)
                                                    @case('file')
                                                        @php
                                                            $fileProperty = $fieldName . '_file';
                                                            $existingUrl = null;
                                                            if (isset($field['existing_url'])) {
                                                                if (is_string($field['existing_url']) && preg_match('/^(https?:\/\/|data:image)/', $field['existing_url'])) {
                                                                    $existingUrl = $field['existing_url'];
                                                                } elseif (is_string($field['existing_url']) && property_exists($this, $field['existing_url'])) {
                                                                    $existingUrl = $this->{$field['existing_url']};
                                                                }
                                                            }
                                                        @endphp
                                                        <x-forms.file-upload 
                                                            wire:model="{{ $fileProperty }}"
                                                            :existingUrl="$existingUrl"
                                                            :accept="$field['accept'] ?? 'image/*'"
                                                            :is-readonly="$isReadonly"
                                                        />
                                                        @error($fileProperty) <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                        @break

                                                    @case('color')
                                                        <div class="d-flex align-items-center gap-2">
                                                            <input type="color"
                                                                   wire:model="formData.{{ $fieldName }}"
                                                                   class="form-control form-control-color"
                                                                   style="width: 60px; height: 38px;"
                                                                {{ $isReadonly ? 'disabled' : '' }}>
                                                            <input type="text"
                                                                   wire:model="formData.{{ $fieldName }}"
                                                                   class="form-control @error('formData.' . $fieldName) is-invalid @enderror"
                                                                   placeholder="{{ $field['placeholder'] ?? '#000000' }}"
                                                                {{ $isReadonly ? 'readonly' : '' }}>
                                                        </div>
                                                        @break

                                                    @case('textarea')
                                                        <textarea wire:model="formData.{{ $fieldName }}"
                                                                  class="form-control @error('formData.' . $fieldName) is-invalid @enderror {{ $isReadonly ? 'bg-light text-muted' : '' }}"
                                                                  rows="{{ $field['rows'] ?? 3 }}"
                                                                  placeholder="{{ $field['placeholder'] ?? '' }}"
                                                                  {{ $isReadonly ? 'readonly' : '' }}></textarea>
                                                        @break

                                                    @case('ckeditor')
                                                    @case('richtext')
                                                        @if(!empty($field['live']))
                                                            <x-forms.ckeditor
                                                                wire:model.live="formData.{{ $fieldName }}"
                                                                :placeholder="$field['placeholder'] ?? 'Enter content...'"
                                                                :is-readonly="$isReadonly"
                                                            />
                                                        @else
                                                            <x-forms.ckeditor
                                                                wire:model="formData.{{ $fieldName }}"
                                                                :placeholder="$field['placeholder'] ?? 'Enter content...'"
                                                                :is-readonly="$isReadonly"
                                                            />
                                                        @endif
                                                        @break

                                                    @case('select')
                                                        @if(!empty($field['live']))
                                                            <x-forms.select2
                                                                wire:model.live="formData.{{ $fieldName }}"
                                                                :options="$field['options'] ?? []"
                                                                :placeholder="$field['placeholder'] ?? 'Select an option'"
                                                                :is-readonly="$isReadonly"
                                                                :multiple="!empty($field['multiple'])"
                                                            />
                                                        @else
                                                            <x-forms.select2
                                                                wire:model="formData.{{ $fieldName }}"
                                                                :options="$field['options'] ?? []"
                                                                :placeholder="$field['placeholder'] ?? 'Select an option'"
                                                                :is-readonly="$isReadonly"
                                                                :multiple="!empty($field['multiple'])"
                                                            />
                                                        @endif
                                                        @break

                                                    @case('schema_builder')
                                                        <div class="border rounded p-3 bg-light" x-data="{
                                                            fields: @entangle('formData.' . $fieldName),
                                                            addField() {
                                                                this.fields.push({ name: '', label: '', type: 'text', required: false });
                                                            },
                                                            removeField(index) {
                                                                this.fields.splice(index, 1);
                                                            }
                                                        }">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-sm mb-2 bg-white">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Field Key</th>
                                                                            <th>Label</th>
                                                                            <th>Type</th>
                                                                            <th class="text-center">Required</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <template x-for="(field, index) in fields" :key="index">
                                                                            <tr>
                                                                                <td><input type="text" class="form-control form-control-sm" x-model="field.name" placeholder="e.g. spouse_name"></td>
                                                                                <td><input type="text" class="form-control form-control-sm" x-model="field.label" placeholder="e.g. Spouse Name"></td>
                                                                                <td>
                                                                                    <select class="form-select form-select-sm" x-model="field.type">
                                                                                        <option value="text">Text</option>
                                                                                        <option value="number">Number</option>
                                                                                        <option value="date">Date</option>
                                                                                        <option value="textarea">Textarea</option>
                                                                                        <option value="file">File Upload</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td class="text-center align-middle">
                                                                                    <input type="checkbox" class="form-check-input" x-model="field.required">
                                                                                </td>
                                                                                <td class="text-center align-middle">
                                                                                    <button type="button" class="btn btn-sm btn-danger px-2 py-1" @click="removeField(index)"><i class="bx bx-trash"></i></button>
                                                                                </td>
                                                                            </tr>
                                                                        </template>
                                                                        <tr x-show="fields.length === 0">
                                                                            <td colspan="5" class="text-center text-muted small py-3">No dynamic fields added.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <button type="button" class="btn btn-sm btn-outline-primary" @click="addField()"><i class="bx bx-plus me-1"></i> Add Field</button>
                                                        </div>
                                                        @break

                                                    @case('checkbox')
                                                        <x-forms.checkbox
                                                            wire:model="formData.{{ $fieldName }}"
                                                            :help="$field['help'] ?? ''"
                                                            :is-readonly="$isReadonly"
                                                        />
                                                        @break

                                                    @case('checkbox-group')
                                                        <div class="row mt-2">
                                                            @foreach($field['options'] ?? [] as $value => $label)
                                                                <div class="col-md-{{ $field['options_col'] ?? 4 }} mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                               value="{{ $value }}"
                                                                               id="chk-{{ $fieldName }}-{{ Str::slug($value) }}"
                                                                               wire:click="updateCheckboxGroup('{{ $fieldName }}', '{{ $value }}', $event.target.checked)"
                                                                               @if(in_array($value, $formData[$fieldName] ?? [])) checked @endif
                                                                            {{ $isReadonly ? 'disabled' : '' }}>
                                                                        <label class="form-check-label" for="chk-{{ $fieldName }}-{{ Str::slug($value) }}">
                                                                            {{ $label }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @break

                                                    @case('date')
                                                        @if(!empty($field['live']))
                                                            <x-forms.datepicker
                                                                wire:model.live="formData.{{ $fieldName }}"
                                                                :placeholder="$field['placeholder'] ?? 'Select date...'"
                                                                :is-readonly="$isReadonly"
                                                            />
                                                        @else
                                                            <x-forms.datepicker
                                                                wire:model="formData.{{ $fieldName }}"
                                                                :placeholder="$field['placeholder'] ?? 'Select date...'"
                                                                :is-readonly="$isReadonly"
                                                            />
                                                        @endif
                                                        @break

                                                    @default
                                                        <input type="{{ $fieldType }}"
                                                               wire:model="formData.{{ $fieldName }}"
                                                               class="form-control @error('formData.' . $fieldName) is-invalid @enderror {{ $isReadonly ? 'bg-light text-muted' : '' }}"
                                                               placeholder="{{ $field['placeholder'] ?? '' }}"
                                                            {{ $isReadonly ? 'readonly' : '' }}>
                                                @endswitch

                                                @error('formData.' . $fieldName)
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror

                                                @if(!empty($field['help']) && $fieldType !== 'checkbox')
                                                    <small class="text-muted d-block mt-2">{{ $field['help'] }}</small>
                                                @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                            <div wire:loading wire:target="save" class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-muted">Saving...</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="close">{{ $cancelButtonText }}</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>{{ $submitButtonText }}</span>
                                <span wire:loading>Saving...</span>
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    @endif
</div>
