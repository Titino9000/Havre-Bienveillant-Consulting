<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        404 Error Logs
    </h4>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Total 404s</h6>
                    <h3 class="mb-0">{{ $stats['total'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Today's 404s</h6>
                    <h3 class="mb-0">{{ $stats['today'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Unique URLs</h6>
                    <h3 class="mb-0">{{ $stats['unique_urls'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Blocked IPs</h6>
                    <h3 class="mb-0">{{ $stats['blocked_ips'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="mb-0">Maintenance</h5>
            <button wire:click="clearLogs" class="btn btn-sm btn-danger shadow-sm" onclick="confirm('Are you sure you want to clear old logs?') || event.stopImmediatePropagation()">Clear Old Logs (30+ Days)</button>
        </div>
    </div>

    @livewire('backend.monitoring.tables.not-found-logs-table')
</div>
