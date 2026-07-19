@props(['placeholder' => 'Select an icon or type custom class'])

<div wire:ignore x-data="{
    value: @entangle($attributes->wire('model')),
    init() {
        let select = $(this.$refs.select);

        function formatIcon(icon) {
            if (!icon.id) {
                return icon.text;
            }
            let iconClass = icon.id;
            if (iconClass.includes('fa-') || iconClass.startsWith('fas ') || iconClass.startsWith('fab ')) {
                if (!iconClass.match(/^(fas|fab|far|fal|fad)\s/)) {
                    iconClass = 'fas ' + iconClass;
                }
            } else {
                iconClass = iconClass.includes(' ') ? iconClass : 'bx ' + iconClass;
                if (!iconClass.includes('bx-') && !iconClass.includes('bxl-') && !iconClass.includes('bxs-')) {
                    iconClass = iconClass.replace('bx ', 'bx bx-');
                }
            }
            return $('<span><i class=\'' + iconClass + ' me-2\'></i> ' + icon.text + '</span>');
        };

        select.select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true,
            tags: true,
            width: '100%',
            dropdownParent: select.closest('.modal').length ? select.closest('.modal') : $(document.body),
            templateResult: formatIcon,
            templateSelection: formatIcon
        });

        // Initialize with current value
        if (this.value) {
            if (select.find('option[value=\'' + this.value + '\']').length === 0) {
                var newOption = new Option(this.value, this.value, true, true);
                select.append(newOption).trigger('change');
            } else {
                select.val(this.value).trigger('change');
            }
        }

        // On change update Livewire
        select.on('change', (e) => {
            this.value = select.val();
        });

        // Watch Livewire changes to update Select2
        this.$watch('value', value => {
            if (select.val() !== value) {
                if (value && select.find('option[value=\'' + value + '\']').length === 0) {
                    var newOption = new Option(value, value, true, true);
                    select.append(newOption).trigger('change');
                } else {
                    select.val(value).trigger('change.select2');
                }
            }
        });
    }
}">
    <select x-ref="select" {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'form-select icon-select2']) }}>
        <option value="">{{ $placeholder }}</option>
        
        {{-- Common Boxicons --}}
        <optgroup label="Common Boxicons">
            <option value="bx-store" data-icon="bx-store">Store</option>
            <option value="bx-cloud" data-icon="bx-cloud">Cloud</option>
            <option value="bx-laptop" data-icon="bx-laptop">Laptop</option>
            <option value="bx-desktop" data-icon="bx-desktop">Desktop</option>
            <option value="bx-mobile" data-icon="bx-mobile">Mobile</option>
            <option value="bx-server" data-icon="bx-server">Server</option>
            <option value="bx-shield-quarter" data-icon="bx-shield-quarter">Security</option>
            <option value="bx-cog" data-icon="bx-cog">Settings</option>
            <option value="bx-code-alt" data-icon="bx-code-alt">Code</option>
            <option value="bx-code-block" data-icon="bx-code-block">Code Block</option>
            <option value="bx-data" data-icon="bx-data">Data</option>
            <option value="bx-network-chart" data-icon="bx-network-chart">Network</option>
            <option value="bx-palette" data-icon="bx-palette">Design / Palette</option>
            <option value="bx-brain" data-icon="bx-brain">AI / Brain</option>
            <option value="bx-line-chart" data-icon="bx-line-chart">Analytics / Chart</option>
            <option value="bx-support" data-icon="bx-support">Support</option>
            <option value="bx-briefcase" data-icon="bx-briefcase">Briefcase</option>
            <option value="bx-buildings" data-icon="bx-buildings">Buildings</option>
            <option value="bx-bulb" data-icon="bx-bulb">Idea / Bulb</option>
        </optgroup>
    </select>
</div>
