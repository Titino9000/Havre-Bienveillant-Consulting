@props(['placeholder' => 'Select date', 'enableTime' => false])

<div wire:ignore x-data="{
    value: @entangle($attributes->wire('model')),
    fp: null,
    init() {
        this.fp = flatpickr(this.$refs.input, {
            enableTime: {{ $enableTime ? 'true' : 'false' }},
            dateFormat: '{{ $enableTime ? 'Y-m-d H:i' : 'Y-m-d' }}',
            defaultDate: this.value || null,
            onChange: (selectedDates, dateStr, instance) => {
                this.value = dateStr;
            }
        });

        // Listen for Livewire updates
        this.$watch('value', val => {
            if (this.fp && val !== this.fp.input.value) {
                this.fp.setDate(val || null);
            }
        });
    }
}">
    <input type="text" x-ref="input" {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'form-control bg-white']) }} placeholder="{{ $placeholder }}">
</div>
