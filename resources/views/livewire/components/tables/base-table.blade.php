{{-- resources/views/livewire/includes/tables/base-table.blade.php --}}
<div>
    @if(count($tabs) > 0)
        <ul class="nav nav-pills mb-3 gap-2">
            @foreach($tabs as $key => $label)
                <li class="nav-item">
                    <button type="button" class="nav-link {{ $currentTab === $key ? 'active' : 'bg-white border text-dark' }}" wire:click="setTab('{{ $key }}')">
                        {{ $label }}
                    </button>
                </li>
            @endforeach
        </ul>
    @endif

    <!-- Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header border-bottom py-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2 mb-3 mb-md-0 fw-bold">{{ $context ?: 'Data Table' }}</h5>
            
            <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
                @if($showSearch)
                    <div class="input-group input-group-merge shadow-sm" style="width: auto; min-width: 250px;">
                        <span class="input-group-text border-end-0 bg-white"><i class="bx bx-search"></i></span>
                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control border-start-0 ps-0" placeholder="Search...">
                    </div>
                @endif

                <div class="d-flex align-items-center gap-2">
                    @if($showCreateButton)
                        <button wire:click="create" class="btn btn-primary shadow-sm">
                            <i class="{{ $createButtonIcon ?? 'bx bx-plus' }} me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">{{ $buttonLabel ?? 'Create' }}</span>
                        </button>
                    @endif
                    @if($showReloadButton)
                        <button wire:click="reload" class="btn btn-outline-secondary btn-icon shadow-sm" title="Reload">
                            <i class="bx bx-refresh"></i>
                        </button>
                    @endif
                    @if($showExportButton)
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><button class="dropdown-item" wire:click="export('xlsx')"><i class="bx bx-spreadsheet me-2 text-success"></i> Excel (XLSX)</button></li>
                                <li><button class="dropdown-item" wire:click="export('csv')"><i class="bx bx-file me-2 text-info"></i> CSV</button></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><button class="dropdown-item" wire:click="export('pdf')"><i class="bx bxs-file-pdf me-2 text-danger"></i> PDF</button></li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Additional Filters Slot (for child classes to inject) -->
        @if(isset($additionalFilters))
            <div class="card-body pt-0 pb-3">
                {!! $additionalFilters !!}
            </div>
        @endif

        <!-- Bulk Actions Bar -->
        @if(count($selected) > 0)
            <div class="bg-primary-subtle p-3 border-bottom">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <span class="text-primary fw-bold"><i class="bx bx-check-circle me-1"></i> {{ count($selected) }} record(s) selected</span>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($bulkActions as $key => $action)
                            @if(is_array($action))
                                @if($action['enabled'] ?? true)
                                    <button wire:click="handleBulkAction('{{ $action['key'] ?? $key }}')" class="btn btn-sm btn-primary shadow-sm">
                                        <i class="{{ $action['icon'] ?? 'bx bx-check' }} me-1"></i> {{ $action['label'] ?? ucfirst($key) }}
                                    </button>
                                @endif
                            @else
                                <button wire:click="handleBulkAction('{{ $key }}')" class="btn btn-sm btn-primary shadow-sm">
                                    <i class="bx bx-check me-1"></i> {{ $action }}
                                </button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="table-responsive text-nowrap d-none d-md-block">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f4f6f8; border-bottom: 2px solid #e0e5ea;">
                <tr>
                    <th width="40" class="text-center">
                        <input type="checkbox" wire:model.live="selectedAll" class="form-check-input">
                    </th>
                    @foreach($columns as $column)
                        <th class="{{ $column['class'] ?? '' }}">
                            @if(!empty($column['sortable']))
                                <button wire:click="sortBy('{{ $column['field'] }}')" class="btn btn-link text-dark text-decoration-none p-0 fw-semibold">
                                    {{ $column['label'] }}
                                    @if($sortField === $column['field'])
                                        <i class="bx bx-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="bx bx-sort-alt-2 ms-1 opacity-50"></i>
                                    @endif
                                </button>
                            @else
                                <span class="fw-semibold">{{ $column['label'] }}</span>
                            @endif
                        </th>
                    @endforeach
                    <th width="100" class="text-center text-nowrap">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($rows as $row)
                    @php
                        $formattedRow = $this->formatRowData($row);
                        $rowActions = method_exists($this, 'getRowActions') ? $this->getRowActions($row) : [];
                        $rowId = $row->id ?? ($row['id'] ?? null);
                    @endphp
                    <tr wire:key="row-{{ $rowId }}">
                        <td class="text-center" data-label="Select">
                            <input type="checkbox" value="{{ $rowId }}" wire:model.live="selected" class="form-check-input">
                        </td>
                        @foreach($columns as $column)
                            <td class="{{ $column['class'] ?? '' }}" data-label="{{ $column['label'] }}">
                                @if(isset($formattedRow[$column['field']]))
                                    {!! $formattedRow[$column['field']] !!}
                                @else
                                    {{ data_get($row, $column['field']) }}
                                @endif
                            </td>
                        @endforeach
                        <td class="text-center text-nowrap" data-label="Actions">
                            <div class="d-flex flex-wrap flex-md-nowrap gap-2 justify-content-center align-items-center">
                                @php
                                    $effectiveMaxInline = $maxInlineActions ?? 2;
                                    if (count($columns) > 5) {
                                        $effectiveMaxInline = 0;
                                    }
                                    $inlineActions = array_slice($rowActions, 0, $effectiveMaxInline, true);
                                    $dropdownActions = array_slice($rowActions, $effectiveMaxInline, null, true);
                                @endphp

                                {{-- Inline Actions --}}
                                @foreach($inlineActions as $actionKey => $action)
                                    @if($action['enabled'] ?? true)
                                        @php
                                            $actionMethod = $action['action'] ?? $actionKey;
                                            $btnClass = $action['btnClass'] ?? 'btn-secondary';
                                        @endphp
                                        <button type="button"
                                                wire:click="{{ $actionMethod }}('{{ $rowId }}')"
                                                class="btn btn-sm btn-icon {{ $btnClass }}"
                                                title="{{ $action['label'] ?? ucfirst($actionKey) }}">
                                            <span wire:loading wire:target="{{ $actionMethod }}('{{ $rowId }}')" class="spinner-border spinner-border-sm"></span>
                                            <i class="{{ $action['iconClass'] ?? 'bx bx-folder' }}" wire:loading.remove wire:target="{{ $actionMethod }}('{{ $rowId }}')"></i>
                                        </button>
                                    @endif
                                @endforeach

                                {{-- Dropdown for remaining actions --}}
                                @if(count($dropdownActions) > 0)
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-icon btn-secondary dropdown-toggle hide-arrow"
                                                type="button"
                                                data-bs-toggle="dropdown"
                                                data-bs-boundary="window"
                                                aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            @foreach($dropdownActions as $actionKey => $action)
                                                @if($action['enabled'] ?? true)
                                                    @php
                                                        $actionMethod = $action['action'] ?? $actionKey;
                                                    @endphp
                                                    <li>
                                                        <button class="dropdown-item d-flex align-items-center" type="button" wire:click="{{ $actionMethod }}('{{ $rowId }}')">
                                                            <i class="{{ $action['iconClass'] ?? 'bx bx-folder' }} me-2"></i>
                                                            {{ $action['label'] ?? ucfirst($actionKey) }}
                                                        </button>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 2 }}" class="text-center py-5">
                            <div class="empty-state py-4">
                                <div class="avatar avatar-xl mb-3 mx-auto">
                                    <span class="avatar-initial rounded-circle bg-label-secondary">
                                        <i class="bx bx-folder-open fs-2"></i>
                                    </span>
                                </div>
                                <h6 class="mb-1">No records found</h6>
                                @if($this->search)
                                    <p class="text-muted small mb-0">We couldn't find any results matching "{{ $this->search }}"</p>
                                @else
                                    <p class="text-muted small mb-0">There are no records available in this section.</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>


            {{-- Deletion is handled globally via foot.blade.php SweetAlert listener --}}
        </div>

        <!-- Mobile List View -->
        <div class="list-group list-group-flush d-md-none">
            @forelse($rows as $row)
                @php
                    $formattedRow = $this->formatRowData($row);
                    $rowActions = method_exists($this, 'getRowActions') ? $this->getRowActions($row) : [];
                    $rowId = $row->id ?? ($row['id'] ?? null);
                @endphp
                <div class="list-group-item p-3" wire:key="mobile-row-{{ $rowId }}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check">
                            <input type="checkbox" value="{{ $rowId }}" wire:model.live="selected" class="form-check-input">
                        </div>
                        <div class="d-flex gap-1">
                            @foreach($rowActions as $actionKey => $action)
                                @if($action['enabled'] ?? true)
                                    @php
                                        $actionMethod = $action['action'] ?? $actionKey;
                                        $btnClass = str_replace('btn-', 'text-', $action['btnClass'] ?? 'btn-secondary');
                                        if (str_starts_with($btnClass, 'text-outline-')) $btnClass = str_replace('text-outline-', 'text-', $btnClass);
                                    @endphp
                                    <button type="button" wire:click="{{ $actionMethod }}('{{ $rowId }}')" class="btn btn-sm btn-icon border-0 {{ $btnClass }}" title="{{ $action['label'] ?? ucfirst($actionKey) }}">
                                        <i class="{{ $action['iconClass'] ?? 'bx bx-folder' }} fs-5"></i>
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @foreach($columns as $index => $column)
                        @if($index === 0)
                            <h6 class="mb-2 fw-semibold">
                                @if(isset($formattedRow[$column['field']]))
                                    {!! $formattedRow[$column['field']] !!}
                                @else
                                    {{ data_get($row, $column['field']) }}
                                @endif
                            </h6>
                        @else
                            <div class="mb-1 small d-flex justify-content-between">
                                <span class="text-muted">{{ $column['label'] }}:</span>
                                <span class="text-end">
                                    @if(isset($formattedRow[$column['field']]))
                                        {!! $formattedRow[$column['field']] !!}
                                    @else
                                        {{ data_get($row, $column['field']) }}
                                    @endif
                                </span>
                            </div>
                        @endif
                    @endforeach
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bx bx-data bx-lg text-muted mb-3 d-block"></i>
                    <p class="text-muted mb-0">No records found</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($rows->hasPages())
            <div class="card-footer">
                {{ $rows->links() }}
            </div>
        @endif
    </div>




    {{-- ===================================================================== --}}
    {{-- REUSABLE VIEW MODAL – displays record details if child component     --}}
    {{-- defines properties: $viewingItem, $viewItemData, $viewItemTitle     --}}
    {{-- ===================================================================== --}}
    {{-- ===================================================================== --}}
    {{-- REUSABLE VIEW MODAL – displays record details                       --}}
    {{-- ===================================================================== --}}
    @livewire('components.views.base-view')

</div>
