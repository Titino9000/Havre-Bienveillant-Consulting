@props(['help' => '', 'isReadonly' => false])

<div class="form-check form-switch mt-2">
    <input type="checkbox" 
           {{ $attributes->merge(['class' => 'form-check-input cursor-pointer', 'style' => 'width: 2.5em; height: 1.25em;']) }} 
           id="checkbox-{{ md5($attributes->whereStartsWith('wire:model')->first()) }}"
           {{ $isReadonly ? 'disabled' : '' }}>
           
    <label class="form-check-label ms-2 pt-1" for="checkbox-{{ md5($attributes->whereStartsWith('wire:model')->first()) }}">
        @if($help)
            <span class="text-muted">{{ $help }}</span>
        @endif
    </label>
</div>
