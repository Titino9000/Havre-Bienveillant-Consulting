<div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: visible;">
    {{-- ------------------------------
         Card Body: Toolbar + Advanced Filters + Table
    ------------------------------- --}}
    <div class="card-header bg-white px-4 pt-4 pb-3 border-bottom-0">
        {{-- Table Title (Dynamic) --}}
        <div class="d-flex align-items-center mb-3">
            <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded" style="width: 40px; height: 40px;">
                <i class="{{ $tableIcon }} fs-4"></i>
            </div>
            <h5 class="mb-0 ms-3 fw-bold text-dark">{{ $tableTitle }}</h5>
        </div>
        
        {{-- Toolbar: Bulk Actions + Search + Create + Reload --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center w-100 gap-3 mb-2">
            {{-- Left: Bulk Actions, Filters, Search --}}
            <div class="d-flex flex-wrap align-items-center gap-3 flex-grow-1">

                {{-- Bulk Actions --}}
                @if(!empty($bulkActions))
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-light border dropdown-toggle d-flex align-items-center fw-medium rounded-pill px-3" type="button" data-bs-toggle="dropdown">
                            <i class='bx bx-cog me-2 text-primary'></i> Bulk Actions
                            @if(!empty($selected))
                                <span class="badge rounded-pill bg-primary ms-2">{{ count($selected) }}</span>
                            @endif
                        </button>

                        <ul class="dropdown-menu shadow-sm border-0 rounded-3">
                            @foreach($bulkActions as $action)
                                @if($action['enabled'] ?? true)
                                    <li>
                                        <button type="button"
                                                class="dropdown-item d-flex align-items-center py-2"
                                                wire:click="$dispatch('bulk-action', { action: '{{ $action['key'] }}' })"
                                                @if(empty($selected)) disabled @endif>
                                            @isset($action['icon'])
                                                <i class="{{ $action['icon'] }} me-2 text-muted"></i>
                                            @endisset
                                            {{ $action['label'] ?? ucfirst($action['key']) }}
                                        </button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Advanced Filter Toggle --}}
                <button class="btn btn-light border d-flex align-items-center fw-medium rounded-pill px-3"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#advancedFilterCard"
                        wire:click="$toggle('showFilterForm')">
                    <i class='bx bx-filter-alt me-2 text-primary'></i> Filters
                </button>

                {{-- Quick Search --}}
                @if($showSearch)
                    <div class="input-group input-group-merge flex-grow-1 flex-md-grow-0" style="max-width: 400px; border-radius: 50px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
                        <span class="input-group-text bg-light border-0 ps-4" id="basic-addon-search31">
                            <i class="bx bx-search text-muted"></i>
                        </span>
                        <input type="text"
                               class="form-control bg-light border-0 pe-4"
                               placeholder="Search records..."
                               aria-label="Search..."
                               aria-describedby="basic-addon-search31"
                               wire:model.live.debounce.500ms="search">
                    </div>
                @endif
            </div>

            {{-- Right: Create & Reload --}}
            <div class="d-flex align-items-center gap-3 flex-shrink-0 mt-3 mt-md-0">
                @if($showReloadButton)
                    <button type="button"
                            class="btn btn-light border btn-icon rounded-circle d-flex align-items-center justify-content-center"
                            title="Reload Table"
                            wire:click="reload"
                            wire:loading.attr="disabled"
                            wire:target="reload"
                            style="width: 40px; height: 40px;">
                        <span wire:loading.remove wire:target="reload">
                            <i class='bx bx-refresh fs-4 text-secondary'></i>
                        </span>
                        <span wire:loading.inline wire:target="reload">
                            <i class="bx bx-loader bx-spin fs-4 text-primary"></i>
                        </span>
                    </button>
                @endif
                
                @if($showCreateButton)
                    <button type="button" class="btn btn-primary d-flex align-items-center fw-semibold rounded-pill px-4"
                            wire:click="$dispatch('action-selector',{action: 'create',id: null})">
                        <i class='bx bx-plus me-2 fs-5'></i> {{ $buttonLabel }}
                    </button>
                @endif
            </div>
        </div>

        {{-- ------------------------------
             Advanced Filter Collapsible
        ------------------------------- --}}
        <div class="collapse mb-3" id="advancedFilterCard" wire:ignore.self>
            <div class="border-label-secondary border-1 no-shadow p-4 mb-3 bg-light rounded">
                <form wire:submit.prevent="applyFilter" class="row g-3 align-items-end">

                    {{-- Field --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Field</label>
                        <select wire:model="filterField" class="form-select">
                            <option value="">Select Field</option>
                            @foreach($columns as $col)
                                <option value="{{ $col['key'] ?? $col['field'] }}">
                                    {{ $col['label'] ?? ucfirst($col['key'] ?? $col['field']) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Operator --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Operator</label>
                        <select wire:model="filterOperator" class="form-select">
                            <option value="contains">Contains</option>
                            <option value="equals">Is Equal To</option>
                            <option value="greater">Is Greater Than</option>
                            <option value="less">Is Less Than</option>
                        </select>
                    </div>

                    {{-- Value --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Value</label>
                        <input type="text" wire:model="filterValue" class="form-control" placeholder="Enter value">
                    </div>

                    {{-- Apply Button --}}
                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class='bx bx-search-alt me-1'></i> Apply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        {{-- ------------------------------
             Table
        ------------------------------- --}}
        <div class="table-responsive position-relative overflow-visible">
            <table class="table table-hover align-middle mb-0 w-100">
                <thead class="bg-light border-top border-bottom text-uppercase text-secondary" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                <tr>
                    <th class="first-column ps-4" style="width: 40px;">
                        <input type="checkbox" class="form-check-input" wire:model.live="selectedAll">
                    </th>
                    @foreach($columns as $col)
                        @php
                            $field = $col['key'] ?? $col['field'];
                            $isSorted = $sortField === $field;
                            $defaultIconUp = 'bx bx-up-arrow-alt';
                            $defaultIconDown = 'bx bx-down-arrow-alt';
                        @endphp

                        <th style="cursor: pointer;" wire:click="sortBy('{{ $field }}')">
                            {{ $col['label'] ?? ucfirst($field) }}
                            <i class="{{ $defaultIconUp }} ms-1 {{ $isSorted && $sortDirection === 'asc' ? 'text-primary' : 'text-muted' }}" style="font-size: 0.85rem;"></i>
                            <i class="{{ $defaultIconDown }} {{ $isSorted && $sortDirection === 'desc' ? 'text-primary' : 'text-muted' }}" style="font-size: 0.85rem; margin-left: -0.5rem"></i>
                        </th>
                    @endforeach
                    <th class="text-end last-column pe-4" style="width: 120px;">Actions</th>
                </tr>
                </thead>

                <tbody>
                @forelse($rows as $row)
                    <tr class="hover-row">
                        {{-- Selection Checkbox --}}
                        <td class="first-column ps-4">
                            <input type="checkbox" class="form-check-input" value="{{ $row->id }}" wire:model.live="selected">
                        </td>

                        {{-- Columns --}}
                        @foreach($columns as $col)
                            <td>
                                @php
                                    $field = $col['key'] ?? $col['field'];
                                    $value = data_get($row, $field);
                                @endphp

                                @switch($col['type'] ?? 'text')

                                    {{-- Icon / Image --}}
                                    @case('icon')
                                        @if(str_starts_with(trim($value), '<i '))
                                            <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded" style="width: 35px; height: 35px;">
                                                {!! $value !!}
                                            </div>
                                        @elseif(str_contains($value, 'bx') || str_contains($value, 'fa-') || str_starts_with($value, 'fas ') || str_starts_with($value, 'fab ') || str_contains($value, '-'))
                                            <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded" style="width: 35px; height: 35px;">
                                                <x-frontend.icon name="{{ $value }}" class="fs-5" />
                                            </div>
                                        @elseif($value)
                                            <img src="{{ asset($value) }}" alt="icon" style="width:35px;height:35px;object-fit:cover" class="rounded border">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                        @break

                                    {{-- Thumbnail --}}
                                    @case('thumbnail')
                                        <img src="{{ $value }}"
                                             alt="{{ $row->title ?? '' }}"
                                             class="rounded"
                                             width="80"
                                             height="60"
                                             onerror="this.onerror=null;this.src='{{ asset('images/default-image.jpg') }}';">
                                        @break

                                        {{-- User Thumbnail --}}
                                    @case('user_thumbnail')
                                        <img src="{{ $value }}"
                                             alt="{{ $row->full_name ?? '' }}"
                                             class="rounded"
                                             width="60"
                                             height="60"
                                             onerror="this.onerror=null;this.src='{{ asset('images/default-image.jpg') }}';">
                                        @break

                                        {{-- Status --}}
                                    @case('status')
                                        <div class="dropdown">
                                            <span class="badge bg-{{ match($value) {
                                                'draft' => 'warning',
                                                'published' => 'success',
                                                'archived' => 'secondary'
                                            } }} dropdown-toggle" role="button" data-bs-toggle="dropdown" style="cursor:pointer;">
                                                {{ ucfirst($value) }}
                                            </span>
                                            <ul class="dropdown-menu">
                                                @foreach(['draft','published','archived'] as $status)
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)" wire:click="updateStatus({{ $row->id }}, '{{ $status }}')">
                                                            {{ ucfirst($status) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @break

                                        {{-- Status --}}
                                    @case('hasRole')
                                        <div class="dropdown">
                                            <span class="badge bg-{{ match($value) {
                                                'manager' => 'warning',
                                                'super_admin' => 'success',
                                                'admin' => 'secondary'
                                            } }} dropdown-toggle" role="button" data-bs-toggle="dropdown" style="cursor:pointer;">
                                                {{ ucfirst($value) }}
                                            </span>
                                            <ul class="dropdown-menu">
                                                @foreach(['manager','super_admin','admin'] as $role)
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)" wire:click="updateRole({{ $row->id }}, '{{ $role }}')">
                                                            {{ ucfirst($role) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @break

                                        {{-- Is Active --}}
                                    @case('is_active')
                                        <span class="badge bg-{{ $value ? 'success' : 'danger' }}"
                                              style="cursor:pointer;"
                                              wire:click="toggleIsActive({{ $row->id }})">
                                                {{ $value ? 'Active' : 'Inactive' }}
                                            </span>
                                        @break

                                        {{-- Featured --}}
                                    @case('is_featured')
                                        <i class="bx bx-star fs-5 {{ $value ? 'text-warning' : 'text-muted' }}"
                                           style="cursor:pointer;"
                                           title="{{ $value ? 'Unmark as Featured' : 'Mark as Featured' }}"
                                           wire:click="toggleFeatured({{ $row->id }})"></i>
                                        @break

                                        {{-- Date --}}
                                    @case('date')
                                        {{ $value ? \Carbon\Carbon::parse($value)->format('d M Y') : '-' }}
                                        @break

                                        {{-- Default --}}
                                    @default
                                        {{ $value }}
                                @endswitch
                            </td>
                        @endforeach

                        {{-- Actions Column --}}
                        <td class="text-end last-column pe-4">
                            @php
                                $enabledActions = collect($this->actions)->filter(fn($config) => $config['enabled'] ?? false);
                            @endphp

                            @if($enabledActions->count() <= 2)
                                {{-- Inline buttons --}}
                                @foreach($enabledActions as $action => $config)
                                    <button class="btn btn-sm btn-icon {{ $config['btnClass'] ?? 'btn-secondary' }}"
                                            title="{{ $config['label'] ?? ucfirst($action) }}"
                                            wire:click="$dispatch('action-selector', { action: '{{ $action }}', id: {{ $row->id }}})">
                                        <i class="{{ $config['iconClass'] ?? 'bx bx-help-circle' }}"></i>
                                    </button>
                                @endforeach
                            @else
                                {{-- Dropdown for 3+ actions --}}
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @foreach($enabledActions as $action => $config)
                                            @if($config['enabled'])
                                                <a class="dropdown-item"
                                                   href="javascript:void(0);"
                                                   title="{{ $config['label'] ?? ucfirst($action) }}"
                                                   wire:click="$dispatch('action-selector', { action: '{{ $action }}', id: {{ $row->id }} })">
                                                    <i class="icon-base {{ $config['iconClass'] ?? 'bx bx-help-circle' }} me-1"></i>
                                                    {{ $config['label'] ?? ucfirst($action) }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 2 }}" class="text-center py-4">No records found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{-- Loading overlay --}}
            <div wire:loading.flex wire:target="reload, search, filterField, filterValue"
                 class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 align-items-center justify-content-center"
                 style="z-index:10;">
                <div class="spinner-border text-primary" style="width:3rem; height:3rem;"></div>
            </div>
        </div>
    </div>

    {{-- ------------------------------
         Pagination
    ------------------------------- --}}
    <div class="card-footer bg-white border-top-0 px-4 pt-3 pb-4">
        @if ($rows && $rows->count())
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Showing {{ $rows->firstItem() }} to {{ $rows->lastItem() }} of {{ $rows->total() }} records
                </div>
                <div>
                    {{ $rows->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
