<?php

namespace App\Livewire\Components\Tables;

use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\Notification\LivewireToast;

abstract class BaseTable extends Component
{
    use WithPagination;
    use LivewireToast;

    protected $paginationTheme = 'bootstrap';

    // Core configuration
    public array $columns = [];
    public string $modelClass = '';
    public array $bulkActions = [];
    public int $perPage = 10;
    public string $context = '';
    public string $buttonLabel = 'Create';
    public int $maxInlineActions = 2;
    public ?string $formComponent = null;

    // Tabs
    public array $tabs = [];
    public string $currentTab = '';

    // Toolbar & Filters
    public string $search = '';
    public bool $showFilterForm = false;
    public ?string $filterField = null;
    public string $filterOperator = 'contains';
    public $filterValue = null;
    public array $nestedFilters = [];
    public array $selectedNestedFilters = [];

    // Selection & Sorting
    public ?string $sortField = null;
    public string $sortDirection = 'asc';
    public array $selected = [];
    public bool $selectedAll = false;

    // UI toggles
    public bool $showSearch = true;
    public bool $showCreateButton = true;
    public bool $showReloadButton = true;
    public bool $showExportButton = true;


    // Reusable view modal properties
    public bool $viewingItem = false;
    public array $viewItemData = [];
    public string $viewItemTitle = 'Record Details';

    /** ----------------------------------------------------------------------------------------------------------------
     * Mount table with defaults
     * -------------------------------------------------------------------------------------------------------------- */
    public function mount(
        array $columns = [],
        string $modelClass = '',
        array $bulkActions = [],
        int $perPage = 10,
        string $context = '',
        string $buttonLabel = 'Create'
    ): void {
        $this->columns = $columns;
        $this->modelClass = $modelClass;
        $this->bulkActions = $bulkActions;
        $this->perPage = $perPage;
        $this->context = $context;
        $this->buttonLabel = $buttonLabel;

        $this->selected = [];
        $this->nestedFilters = [];
        $this->selectedNestedFilters = [];
        $this->tabs = [];
        $this->currentTab = '';
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Rows with search, filter, sort
     * -------------------------------------------------------------------------------------------------------------- */
    #[Computed]
    public function rows()
    {
        if (empty($this->modelClass)) {
            return collect();
        }

        $query = ($this->modelClass)::query();

        $this->applyEagerLoading($query);
        $this->applySearch($query);
        $this->applyFilters($query);
        $this->applyCustomFilters($query);
        $this->applySorting($query);

        $paginated = $query->paginate($this->perPage);
        return $paginated;
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Enhanced search with relationship support
     * -------------------------------------------------------------------------------------------------------------- */
    protected function applySearch($query): void
    {
        if (empty($this->search)) {
            return;
        }

        $searchTerm = '%' . $this->search . '%';

        $query->where(function ($q) use ($searchTerm) {
            foreach ($this->columns as $column) {
                if (empty($column['searchable'])) {
                    continue;
                }

                $field = $column['field'];
                $searchFields = $column['searchFields'] ?? [$field];

                foreach ($searchFields as $searchField) {
                    // Check if it's a relationship field (contains dot notation)
                    if (str_contains($searchField, '.')) {
                        $this->applyRelationshipSearch($q, $searchField, $searchTerm);
                    } else {
                        // Regular field search
                        $q->orWhere($this->getTableName($q) . '.' . $searchField, 'like', $searchTerm);
                    }
                }
            }
        });
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Apply relationship search using whereHas
     * -------------------------------------------------------------------------------------------------------------- */
    protected function applyRelationshipSearch($query, string $field, string $searchTerm): void
    {
        $parts = explode('.', $field);
        $relationName = $parts[0];
        $relationField = $parts[1];

        $query->orWhereHas($relationName, function ($subQuery) use ($relationField, $searchTerm) {
            $subQuery->where($relationField, 'like', $searchTerm);
        });
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Apply standard filters
     * -------------------------------------------------------------------------------------------------------------- */
    protected function applyFilters($query): void
    {
        if (!$this->filterField || !$this->filterValue) {
            return;
        }

        switch ($this->filterOperator) {
            case 'equals':
                $query->where($this->filterField, $this->filterValue);
                break;
            case 'greater':
                $query->where($this->filterField, '>', $this->filterValue);
                break;
            case 'less':
                $query->where($this->filterField, '<', $this->filterValue);
                break;
            default:
                $query->where($this->filterField, 'like', "%{$this->filterValue}%");
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Enhanced sorting with relationship support
     * -------------------------------------------------------------------------------------------------------------- */
    protected function applySorting($query): void
    {
        if (!$this->sortField) {
            return;
        }

        // Check if sorting on a relationship field
        if (str_contains($this->sortField, '.')) {
            $this->applyRelationshipSorting($query, $this->sortField, $this->sortDirection);
        } else {
            $query->orderBy($this->getTableName($query) . '.' . $this->sortField, $this->sortDirection);
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Apply relationship sorting using join
     * -------------------------------------------------------------------------------------------------------------- */
    protected function applyRelationshipSorting($query, string $field, string $direction): void
    {
        $parts = explode('.', $field);
        $relationName = $parts[0];
        $relationField = $parts[1];

        // Get the relation instance
        $relation = $query->getModel()->{$relationName}();
        $relatedTable = $relation->getRelated()->getTable();
        $foreignKey = $relation->getForeignKeyName();
        $localKey = $relation->getLocalKeyName();

        // Join the relationship table
        $query->leftJoin($relatedTable, function ($join) use ($relatedTable, $foreignKey, $localKey) {
            $join->on($this->getTableName($query) . '.' . $foreignKey, '=', $relatedTable . '.' . $localKey);
        });

        // Order by the related field
        $query->orderBy($relatedTable . '.' . $relationField, $direction);

        // Prevent column ambiguity in select
        $query->addSelect($this->getTableName($query) . '.*');
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Get the table name from the query
     * -------------------------------------------------------------------------------------------------------------- */
    protected function getTableName($query): string
    {
        return $query->getModel()->getTable();
    }

    protected function applyEagerLoading($query): void {}
    protected function applyCustomFilters($query): void {}

    protected function formatRowData($row): array
    {
        $data = [];
        foreach ($this->columns as $column) {
            $field = $column['field'];
            $value = data_get($row, $field);

            if (isset($column['type'])) {
                if ($column['type'] === 'image' && $value) {
                    $value = '<img src="' . asset('storage/' . $value) . '" alt="Thumbnail" class="rounded border shadow-sm" style="height: 45px; width: 45px; object-fit: cover;">';
                } elseif ($column['type'] === 'badge') {
                    $color = $column['badge_color'] ?? 'primary';
                    if (is_callable($color)) {
                        $color = $color($value, $row);
                    } elseif (is_array($color)) {
                        $color = $color[$value] ?? 'secondary';
                    }
                    $value = '<span class="badge bg-label-' . $color . '">' . e($value) . '</span>';
                }
            }

            $data[$field] = $value;
        }
        return $data;
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Default Create Action (can be overridden by child tables)
     * -------------------------------------------------------------------------------------------------------------- */
    public function create()
    {
        if ($this->formComponent) {
            $this->dispatch('openCreateForm')->to($this->formComponent);
        } else {
            $this->dispatch('openCreateForm');
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Sorting toggle
     * -------------------------------------------------------------------------------------------------------------- */
    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Switch Tabs
     * -------------------------------------------------------------------------------------------------------------- */
    public function setTab(string $tabKey): void
    {
        $this->currentTab = $tabKey;
        $this->resetPage();
    }



    /** ----------------------------------------------------------------------------------------------------------------
     * Apply filter
     * -------------------------------------------------------------------------------------------------------------- */
    public function applyFilter(): void
    {
        $this->resetPage();
        $this->toastNotification(
            'Filters Applied Successfully',
            'success',
            'Filters',
            'bottom-end',
            5000
        );
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Reload table
     * -------------------------------------------------------------------------------------------------------------- */
    #[On('refresh-table')]
    public function reload(): void
    {
        $this->resetPage();
        unset($this->rows);
        $this->toastNotification(
            'Table Reloaded Successfully',
            'info',
            'Refresh',
            'bottom-end',
            3000
        );
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Bulk actions
     * -------------------------------------------------------------------------------------------------------------- */
    #[On('bulk-action')]
    public function handleBulkAction(string $action): void
    {
        if (empty($this->selected)) {
            $this->toastNotification(
                'Please select at least one record.',
                'warning',
                'No Selection',
                'bottom-end',
                3000
            );
            return;
        }

        switch ($action) {
            case 'delete':
                $this->dispatch('confirmBulkDelete',
                    ids : $this->selected,
                    title : 'Delete Selected Records',
                    text : 'Are you sure you want to delete the selected record(s)?',
                    type : 'warning'
                );
                break;
            default:
                $count = count($this->selected);
                $this->dispatch('bulkAction', action: $action, ids: $this->selected);
                $this->selected = [];
                $this->selectedAll = false;
                $this->toastNotification(
                    $count . ' records processed successfully!',
                    'success',
                    'Success',
                    'bottom-end',
                    3000
                );
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Bulk delete handler
     * -------------------------------------------------------------------------------------------------------------- */
    #[On('bulkDeleteHandler')]
    public function bulkDeleteHandler(array $ids): void
    {
        $selectedIds = $ids['ids'] ?? $ids;

        if (empty($selectedIds)) {
            $this->toastNotification(
                'No records selected for deletion.',
                'error',
                'Error',
                'bottom-end',
                3000
            );
            return;
        }

        try {
            $deleted = ($this->modelClass)::whereIn('id', $selectedIds)->delete();

            $this->toastNotification(
                $deleted . ' record(s) deleted successfully!',
                'success',
                'Deleted',
                'bottom-end',
                5000
            );

            $this->selected = [];
            $this->selectedAll = false;
            $this->dispatch('refresh-table');
        } catch (\Exception $e) {
            $this->toastNotification(
                'Error deleting records: ' . $e->getMessage(),
                'error',
                'Error',
                'bottom-end',
                5000
            );
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Default Row Actions (Can be overridden by child classes)
     * -------------------------------------------------------------------------------------------------------------- */
    public function getRowActions($row): array
    {
        return [
            'view' => [
                'action' => 'view',
                'label' => 'View',
                'iconClass' => 'bx bx-show',
                'btnClass' => 'text-info',
                'enabled' => true,
            ],
            'edit' => [
                'action' => 'edit',
                'label' => 'Edit',
                'iconClass' => 'bx bx-edit-alt',
                'btnClass' => 'text-primary',
                'enabled' => true,
            ],
            'delete' => [
                'action' => 'delete',
                'label' => 'Delete',
                'iconClass' => 'bx bx-trash',
                'btnClass' => 'text-danger',
                'enabled' => true,
            ]
        ];
    }

    public function view($id): void
    {
        $this->dispatch('viewRecord', id: $id);
    }

    #[On('viewRecord')]
    public function handleViewRecord($id): void
    {
        if (is_array($id)) {
            $id = $id['id'] ?? null;
        }

        if (!$id) return;

        $record = ($this->modelClass)::find($id);
        if ($record) {
            $this->dispatch('openViewModal', data: $record->toArray(), title: class_basename($this->modelClass) . ' Details')->to('components.views.base-view');
        }
    }

    public function edit($id): void
    {
        $this->dispatch('editRecord', id: $id);
    }

    public function delete($id): void
    {
        // Default delete triggers a confirmation modal which then calls deleteHandler
        $this->dispatch('confirmDelete', 
            id: $id, 
            title: 'Delete Record', 
            text: 'Are you sure you want to delete this record? This action cannot be undone.', 
            type: 'warning'
        );
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Single delete handler (called after confirmation)
     * -------------------------------------------------------------------------------------------------------------- */
    #[On('deleteHandler')]
    public function deleteHandler($id = null): void
    {
        if (is_array($id)) {
            $id = $id['id'] ?? null;
        }

        if (!$id) {
            $this->toastNotification(
                'No ID provided for deletion.',
                'error',
                'Error',
                'bottom-end',
                3000
            );
            return;
        }

        try {
            ($this->modelClass)::where('id', $id)->delete();

            $this->toastNotification(
                'Record deleted successfully!',
                'success',
                'Deleted',
                'bottom-end',
                3000
            );

            $this->dispatch('refresh-table');
        } catch (\Exception $e) {
            $this->toastNotification(
                'Error deleting record: ' . $e->getMessage(),
                'error',
                'Error',
                'bottom-end',
                5000
            );
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Select all toggle
     * -------------------------------------------------------------------------------------------------------------- */
    public function updatedSelectedAll($value): void
    {
        if ($value) {
            $query = ($this->modelClass)::query();
            $this->applyEagerLoading($query);
            $this->applySearch($query);
            $this->applyFilters($query);
            $this->applyCustomFilters($query);
            $this->applySorting($query);
            // Get only IDs from the current page
            $ids = $query->limit($this->perPage)
                ->offset(($this->getPage() - 1) * $this->perPage)
                ->pluck('id')
                ->toArray();
            $this->selected = $ids;
        } else {
            $this->selected = [];
        }
    }

// Helper to get current page (Livewire’s paginator uses 'page' query param)
    protected function getPage(): int
    {
        return (int) request()->get('page', 1);
    }
    /** ----------------------------------------------------------------------------------------------------------------
     * Individual row selection toggle
     * -------------------------------------------------------------------------------------------------------------- */
    public function updatedSelected(): void
    {
        $query = ($this->modelClass)::query();
        $this->applyEagerLoading($query);
        $this->applySearch($query);
        $this->applyFilters($query);
        $this->applyCustomFilters($query);
        $pageIds = $query->limit($this->perPage)
            ->offset(($this->getPage() - 1) * $this->perPage)
            ->pluck('id')
            ->toArray();
        $this->selectedAll = count($this->selected) === count($pageIds) && !empty($pageIds);
    }
    /** ----------------------------------------------------------------------------------------------------------------
     * Reset filters
     * -------------------------------------------------------------------------------------------------------------- */
    public function resetFilters(): void
    {
        $this->search = '';
        $this->filterField = null;
        $this->filterValue = null;
        $this->filterOperator = 'contains';
        $this->resetPage();

        $this->toastNotification(
            'Filters cleared successfully!',
            'info',
            'Cleared',
            'bottom-end',
            3000
        );
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Clear all filters (alias for resetFilters)
     * -------------------------------------------------------------------------------------------------------------- */
    public function clearAllFilters(): void
    {
        $this->resetFilters();
    }

    public function export($format = 'xlsx')
    {
        try {
            if (!class_exists(\Maatwebsite\Excel\Facades\Excel::class)) {
                throw new \Exception("Maatwebsite/Excel is not installed.");
            }

            $query = ($this->modelClass)::query();
            $this->applyEagerLoading($query);
            $this->applySearch($query);
            $this->applyFilters($query);
            $this->applyCustomFilters($query);
            $this->applySorting($query);

            $data = $query->get()->map(function ($row) {
                return $this->formatRowData($row);
            });

            $filename = ($this->context ?: 'export') . '-' . date('Y-m-d') . '.' . $format;

            $this->toastNotification('Exporting file...', 'info');

            $writerType = match($format) {
                'pdf' => \Maatwebsite\Excel\Excel::DOMPDF,
                'csv' => \Maatwebsite\Excel\Excel::CSV,
                default => \Maatwebsite\Excel\Excel::XLSX,
            };

            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\GenericTableExport($data, $this->columns),
                $filename,
                $writerType
            );
        } catch (\Exception $e) {
            $this->toastNotification('Export Failed: ' . $e->getMessage(), 'error');
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Closing View Modal
     * -------------------------------------------------------------------------------------------------------------- */

    public function closeViewModal(): void
    {
        $this->viewingItem = false;
        $this->viewItemData = [];
        // optionally reset title if you change it dynamically
        // $this->viewItemTitle = 'Record Details';
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Render view
     * -------------------------------------------------------------------------------------------------------------- */
    public function render()
    {
        return view('livewire.components.tables.base-table', [
            'rows' => $this->rows,
        ]);
    }
}
