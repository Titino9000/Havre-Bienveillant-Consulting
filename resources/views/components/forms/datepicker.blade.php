@props(['placeholder' => 'Select date...', 'isReadonly' => false])

<div wire:ignore>
    <div class="input-group input-group-merge">
        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
        <input type="text" 
               id="datepicker-{{ md5($attributes->whereStartsWith('wire:model')->first()) }}"
               {{ $attributes->merge(['class' => 'form-control bg-white']) }} 
               placeholder="{{ $placeholder }}"
               {{ $isReadonly ? 'disabled' : '' }}>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        const id = 'datepicker-{{ md5($attributes->whereStartsWith('wire:model')->first()) }}';
        const el = document.getElementById(id);
        const propName = '{{ $attributes->whereStartsWith('wire:model')->first() }}';
        
        if (el && typeof flatpickr !== 'undefined') {
            flatpickr(el, {
                dateFormat: "Y-m-d",
                allowInput: true,
                onChange: function(selectedDates, dateStr, instance) {
                    @this.set(propName, dateStr);
                }
            });
        }
    });
</script>
