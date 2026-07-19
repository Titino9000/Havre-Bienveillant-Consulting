@props(['options' => [], 'multiple' => false, 'placeholder' => 'Select an option'])

<div wire:ignore x-data="{
    value: @entangle($attributes->wire('model')),
    init() {
        let select = $(this.$refs.select);
        
        select.select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true,
            width: '100%',
            dropdownParent: select.closest('.modal').length ? select.closest('.modal') : $(document.body)
        });

        // Initialize with current value
        if (this.value) {
            select.val(this.value).trigger('change.select2');
        }

        // Update Livewire on change
        select.on('change', (e) => {
            this.value = select.val();
        });

        // Listen for Livewire updates
        this.$watch('value', value => {
            if (select.val() !== value) {
                select.val(value).trigger('change.select2');
            }
        });
    }
}">
    <select x-ref="select" {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'form-select']) }} @if($multiple) multiple="multiple" @endif>
        @if(!$multiple)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options as $val => $label)
            <option value="{{ $val }}">{{ $label }}</option>
        @endforeach
        {{ $slot }}
    </select>
</div>
