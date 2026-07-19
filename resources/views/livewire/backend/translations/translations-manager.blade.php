<div>
    <div class="card shadow-sm border-0">
        <div class="card-header border-bottom py-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2 mb-3 mb-md-0 fw-bold">Translation Manager</h5>
            
            <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
                <div class="input-group input-group-merge shadow-sm" style="width: auto; min-width: 250px;">
                    <span class="input-group-text border-end-0 bg-white"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Search translations..." wire:model.live.debounce.300ms="search">
                </div>
                
                <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addTranslationModal">
                    <i class="bx bx-plus me-1"></i> Add Translation
                </button>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f4f6f8; border-bottom: 2px solid #e0e5ea;">
                    <tr>
                        <th>Key (Usually English)</th>
                        <th>English (en)</th>
                        <th>French (fr)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($filteredTranslations as $key => $values)
                        <tr>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 250px;" title="{{ $key }}">
                                    {{ $key }}
                                </span>
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 250px;" title="{{ $values['en'] }}">
                                    {{ $values['en'] }}
                                </span>
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 250px;" title="{{ $values['fr'] }}">
                                    {{ $values['fr'] }}
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-icon btn-outline-primary me-2" 
                                        wire:click="edit('{{ addslashes($key) }}')" 
                                        data-bs-toggle="modal" data-bs-target="#editTranslationModal">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-icon btn-outline-danger" 
                                        wire:click="delete('{{ addslashes($key) }}')"
                                        wire:confirm="Are you sure you want to delete this translation key?">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No translations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editTranslationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Translation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveEdit">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Key (Cannot be changed)</label>
                            <input type="text" class="form-control" wire:model="editingKey" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">English Value</label>
                            <textarea class="form-control" wire:model="editingEn" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">French Value</label>
                            <textarea class="form-control" wire:model="editingFr" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="addTranslationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Translation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveNew">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Key (The exact English string used in code)</label>
                            <textarea class="form-control" wire:model="newKey" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">English Value</label>
                            <textarea class="form-control" wire:model="newEn" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">French Value</label>
                            <textarea class="form-control" wire:model="newFr" rows="2" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Translation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @script
    <script>
        $wire.on('close-modal', () => {
            const editModal = bootstrap.Modal.getInstance(document.getElementById('editTranslationModal'));
            if (editModal) editModal.hide();
            
            const addModal = bootstrap.Modal.getInstance(document.getElementById('addTranslationModal'));
            if (addModal) addModal.hide();
        });
        
        $wire.on('notify', (data) => {
            // Using standard alert, assuming toastr or similar might not be global
            alert(data[0].message);
        });
    </script>
    @endscript
</div>
