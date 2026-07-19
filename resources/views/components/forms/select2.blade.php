@props(['options' => [], 'placeholder' => 'Select an option', 'isReadonly' => false, 'multiple' => false])

<div wire:ignore>
    <select {{ $attributes->merge(['class' => 'form-select select2']) }} 
            id="select2-{{ md5($attributes->whereStartsWith('wire:model')->first()) }}"
            data-placeholder="{{ $placeholder }}"
            {{ $multiple ? 'multiple' : '' }}
            {{ $isReadonly ? 'disabled' : '' }}>
        
        @if(!$multiple)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        const id = 'select2-{{ md5($attributes->whereStartsWith('wire:model')->first()) }}';
        const propName = '{{ $attributes->whereStartsWith('wire:model')->first() }}';
        
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('#' + id).select2({
                theme: 'bootstrap-5',
                width: '100%'
            }).on('change', function (e) {
                let data = $(this).val();
                @this.set(propName, data);
            });
        }
    });
</script>
