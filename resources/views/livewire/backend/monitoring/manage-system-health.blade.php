<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <h4 class="fw-bold mb-0">System Health Monitor</h4>
        <div>
            <button wire:click="manualHealthCheck" class="btn btn-primary me-2" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="manualHealthCheck">Manual Check</span>
                <span wire:loading wire:target="manualHealthCheck">Checking...</span>
            </button>
            <button wire:click="refreshStats" class="btn btn-outline-secondary" wire:loading.attr="disabled">
                <i class="bx bx-refresh me-1"></i> Refresh
            </button>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session()->has('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    <div class="row">
        <!-- Server Stats -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-start justify-content-center">
                            <h6 class="mb-1 text-muted">Disk Usage</h6>
                            <h4 class="mb-0">{{ $stats['server']['disk_usage']['percentage'] ?? 0 }}%</h4>
                        </div>
                        <div class="avatar bg-label-primary p-2 rounded">
                            <i class="bx bx-hdd fs-4"></i>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-{{ $stats['server']['disk_usage']['status'] ?? 'primary' }}" role="progressbar" style="width: {{ $stats['server']['disk_usage']['percentage'] ?? 0 }}%" aria-valuenow="{{ $stats['server']['disk_usage']['percentage'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted">{{ $stats['server']['disk_usage']['used'] ?? '0 B' }} used of {{ $stats['server']['disk_usage']['total'] ?? '0 B' }}</small>
                </div>
            </div>
        </div>

        <!-- Memory Stats -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-start justify-content-center">
                            <h6 class="mb-1 text-muted">Memory Usage</h6>
                            <h4 class="mb-0">{{ $stats['server']['memory_usage'] ?? '0 B' }}</h4>
                        </div>
                        <div class="avatar bg-label-info p-2 rounded">
                            <i class="bx bx-chip fs-4"></i>
                        </div>
                    </div>
                    <small class="text-muted">Limit: {{ $stats['server']['memory_limit'] ?? 'N/A' }}</small>
                </div>
            </div>
        </div>

        <!-- Database Stats -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-start justify-content-center">
                            <h6 class="mb-1 text-muted">Database</h6>
                            <h4 class="mb-0">{{ $stats['database']['status'] ?? 'Unknown' }}</h4>
                        </div>
                        <div class="avatar bg-label-success p-2 rounded">
                            <i class="bx bx-data fs-4"></i>
                        </div>
                    </div>
                    <small class="text-muted">{{ $stats['database']['table_count'] ?? 0 }} tables ({{ $stats['database']['size'] ?? '0 B' }})</small>
                </div>
            </div>
        </div>

        <!-- Cache Stats -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-start justify-content-center">
                            <h6 class="mb-1 text-muted">Cache Status</h6>
                            <h4 class="mb-0">{{ $stats['cache']['status'] ?? 'Unknown' }}</h4>
                        </div>
                        <div class="avatar bg-label-warning p-2 rounded">
                            <i class="bx bx-bolt-circle fs-4"></i>
                        </div>
                    </div>
                    <small class="text-muted">Driver: {{ $stats['cache']['driver'] ?? 'N/A' }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Log Files -->
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Log Files</h5>
                    <button wire:click="clearOldLogs" class="btn btn-sm btn-danger shadow-sm">Clear Old Logs</button>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #f4f6f8; border-bottom: 2px solid #e0e5ea;">
                            <tr>
                                <th>File Name</th>
                                <th>Size</th>
                                <th>Last Modified</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($logFiles as $log)
                                <tr>
                                    <td><strong>{{ $log['name'] }}</strong></td>
                                    <td>{{ $log['size'] }}</td>
                                    <td>{{ $log['modified_human'] }}</td>
                                    <td>
                                        <button wire:click="downloadLog('{{ $log['name'] }}')" class="btn btn-sm btn-outline-primary"><i class="bx bx-download"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No log files found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
