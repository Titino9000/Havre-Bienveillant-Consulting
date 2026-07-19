@props(['id', 'title'])
<div class="offcanvas offcanvas-end" tabindex="-1" id="{{ $id }}" aria-labelledby="{{ $id }}Label">
    <div class="offcanvas-header border-bottom">
        <h5 id="{{ $id }}Label" class="offcanvas-title fw-bold">{{ $title }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        {{ $slot }}
    </div>
</div>
