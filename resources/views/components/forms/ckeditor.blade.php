@props(['isReadonly' => false, 'placeholder' => 'Enter content...'])

<div wire:ignore>
    <style>
        .ck-editor__editable_inline {
            min-height: 150px;
            border-bottom-left-radius: 0.375rem !important;
            border-bottom-right-radius: 0.375rem !important;
        }
        .ck-toolbar {
            border-top-left-radius: 0.375rem !important;
            border-top-right-radius: 0.375rem !important;
            background-color: #f8f9fa !important;
        }
    </style>
    <textarea {{ $attributes->merge(['class' => 'form-control']) }} 
              id="editor-{{ md5($attributes->whereStartsWith('wire:model')->first()) }}"
              {{ $isReadonly ? 'readonly' : '' }}>
    </textarea>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        const id = 'editor-{{ md5($attributes->whereStartsWith('wire:model')->first()) }}';
        const el = document.getElementById(id);
        const propName = '{{ $attributes->whereStartsWith('wire:model')->first() }}';
        
        if (el && typeof ClassicEditor !== 'undefined') {
            ClassicEditor.create(el, {
                placeholder: '{{ $placeholder }}'
            }).then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set(propName, editor.getData());
                });
            }).catch(error => {
                console.error(error);
            });
        }
    });
</script>
