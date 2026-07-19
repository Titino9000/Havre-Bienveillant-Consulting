<div wire:ignore x-data="{
    value: @entangle($attributes->wire('model')),
    editor: null,
    init() {
        ClassicEditor
            .create(this.$refs.textarea)
            .then(editor => {
                this.editor = editor;
                
                // Set initial value from Livewire
                editor.setData(this.value || '');

                // Update Livewire on change
                editor.model.document.on('change:data', () => {
                    this.value = editor.getData();
                });
                
                // Listen for Livewire updates to update CKEditor (e.g., when editing different items in a modal)
                this.$watch('value', val => {
                    if (val !== editor.getData()) {
                        editor.setData(val || '');
                    }
                });
            })
            .catch(error => {
                console.error(error);
            });
    }
}">
    <style>
        .ck-editor__editable_inline {
            min-height: {{ $attributes->get('height', '500px') }} !important;
        }
    </style>
    <textarea x-ref="textarea" {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'form-control']) }}></textarea>
</div>
