<div>
    <!-- Global Search Modal -->
    <div wire:ignore.self class="modal fade" id="globalSearchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header border-bottom p-2">
                    <div class="input-group input-group-merge border-0">
                        <span class="input-group-text border-0 text-muted fs-4 bg-transparent"><i class="bx bx-search"></i></span>
                        <input type="text" wire:model.live.debounce.300ms="query" class="form-control border-0 fs-4 shadow-none form-control-lg bg-transparent" placeholder="Search across services, team, FAQs..." autocomplete="off">
                        <span class="input-group-text border-0 text-muted bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </span>
                    </div>
                </div>
                <div class="modal-body p-0" style="min-height: 250px;">
                    @if(strlen($query) < 2)
                        <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5 text-muted" style="min-height: 250px;">
                            <i class="bx bx-search fs-1 mb-3 text-lighter"></i>
                            <h6 class="mb-1">Ready to search?</h6>
                            <p class="mb-0 small">Start typing to search globally.</p>
                        </div>
                    @elseif($results->isEmpty())
                        <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5 text-muted" style="min-height: 250px;">
                            <i class="bx bx-error-circle fs-1 mb-3 text-lighter"></i>
                            <h6 class="mb-1">No results found for "{{ $query }}"</h6>
                            <p class="mb-0 small">Try checking your spelling or using different keywords.</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush rounded-0 pb-2">
                            @foreach($results as $type => $items)
                                <div class="list-group-item bg-label-secondary fw-bold text-uppercase fs-tiny py-2 border-0 mt-2">{{ $type }}</div>
                                @foreach($items as $item)
                                    <a href="{{ $item['url'] }}" class="list-group-item list-group-item-action d-flex align-items-center px-4 py-3 border-0">
                                        <div class="avatar avatar-sm me-3 flex-shrink-0">
                                            <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx {{ $item['icon'] }}"></i></span>
                                        </div>
                                        <div class="flex-grow-1 text-truncate">
                                            <h6 class="mb-0 text-heading">{{ $item['title'] }}</h6>
                                        </div>
                                        <i class="bx bx-chevron-right text-muted ms-3"></i>
                                    </a>
                                @endforeach
                            @endforeach
                        </div>
                    @endif
                </div>
                @if(!$results->isEmpty())
                    <div class="modal-footer border-top p-3 bg-lighter justify-content-between">
                        <small class="text-muted"><span class="fw-bold">{{ collect($results)->flatten(1)->count() }}</span> total results found.</small>
                        <small class="text-muted">Press <kbd>ESC</kbd> to close.</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('keydown', function(e) {
            // CTRL+K shortcut to open mega search
            if (e.ctrlKey && e.key === 'k') {
                e.preventDefault();
                var searchModal = new bootstrap.Modal(document.getElementById('globalSearchModal'));
                searchModal.show();
            }
        });
        
        document.getElementById('globalSearchModal').addEventListener('shown.bs.modal', function () {
            // Auto focus input when modal opens
            this.querySelector('input[type="text"]').focus();
        });
    </script>
    @endpush
</div>
