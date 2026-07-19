@props([
    'existingUrl' => null,
    'accept' => 'image/*',
    'isReadonly' => false
])

<div class="position-relative">
    @if($existingUrl)
        <div class="mb-3 p-2 border rounded bg-white text-center shadow-sm d-flex justify-content-center align-items-center" style="min-height: 100px;">
            @if(str_contains($accept, 'image'))
                <img src="{{ $existingUrl }}" alt="Current File" class="img-fluid rounded" style="max-height: 150px; object-fit: contain;">
            @else
                <a href="{{ $existingUrl }}" target="_blank" class="btn btn-sm btn-label-primary fw-bold"><i class="bx bx-link-external me-1"></i> View Current File</a>
            @endif
        </div>
    @endif

    @if(!$isReadonly)
        <div class="file-upload-wrapper p-4 border border-2 rounded text-center bg-white shadow-sm" style="border-style: dashed !important; border-color: var(--bs-primary) !important; opacity: 0.8; transition: all 0.2s;">
            <i class="bx bx-cloud-upload text-primary mb-2" style="font-size: 3rem;"></i>
            <h6 class="mb-1 text-dark fw-bold">Select a file to upload</h6>
            <small class="text-muted d-block mb-3">Accepted formats: {{ $accept }}</small>
            
            <input type="file" 
                   {{ $attributes->merge(['class' => 'form-control']) }} 
                   accept="{{ $accept }}">
        </div>
               
        <!-- Livewire Loading State -->
        @php
            $modelTarget = $attributes->whereStartsWith('wire:model')->first();
        @endphp
        @if($modelTarget)
            <div wire:loading wire:target="{{ $modelTarget }}" class="mt-2 text-primary small fw-bold d-flex align-items-center">
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Uploading your file, please wait...
            </div>
        @endif
    @endif
</div>
