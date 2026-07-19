@props(['title' => null, 'action' => null])
<div class="card shadow-sm border-0 mb-4" {{ $attributes }}>
    @if($title || $action)
    <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom pb-3">
        @if($title)<h5 class="card-title mb-0 fw-bold">{{ $title }}</h5>@endif
        @if($action)<div>{{ $action }}</div>@endif
    </div>
    @endif
    <div class="card-body pt-4">
        {{ $slot }}
    </div>
</div>
