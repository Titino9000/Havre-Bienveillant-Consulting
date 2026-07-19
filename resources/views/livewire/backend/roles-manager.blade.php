<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Manage /</span> Roles & Permissions</h4>
            <button class="btn btn-primary" wire:click="resetInputFields" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRole">
                <i class="bx bx-plus me-1"></i> Add Role
            </button>
        </div>

        <div class="row g-4">
            @forelse($roles as $role)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 custom-hover-lift">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title mb-1 fw-bold text-capitalize">{{ $role->name }}</h5>
                                    <span class="badge bg-label-primary">{{ $role->users()->count() }} Users</span>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button class="dropdown-item" wire:click="edit({{ $role->id }})"><i class="bx bx-edit me-2"></i> Edit Role</button></li>
                                        @if($role->name !== 'super-admin')
                                            <li><hr class="dropdown-divider"></li>
                                            <li><button class="dropdown-item text-danger" wire:click="delete({{ $role->id }})" wire:confirm="Delete this role?"><i class="bx bx-trash me-2"></i> Delete</button></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            
                            <p class="text-muted small mb-0 fw-semibold">Assigned Permissions:</p>
                            <div class="d-flex flex-wrap gap-1 mt-2">
                                @forelse($role->permissions->take(5) as $permission)
                                    <span class="badge bg-label-secondary" style="font-size: 0.75rem;">{{ $permission->name }}</span>
                                @empty
                                    <span class="text-muted small">No specific permissions.</span>
                                @endforelse
                                @if($role->permissions->count() > 5)
                                    <span class="badge bg-label-secondary" style="font-size: 0.75rem;">+{{ $role->permissions->count() - 5 }} more</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted mb-0">No roles found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Offcanvas Form -->
    <x-backend.ui.offcanvas id="offcanvasRole" title="{{ $isEditMode ? 'Edit Role' : 'Add New Role' }}">
        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label class="form-label fw-bold">Role Name</label>
                <input type="text" wire:model="name" class="form-control" placeholder="e.g. editor, manager">
                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Permissions</label>
                <div class="border rounded p-3 bg-light">
                    @forelse($allPermissions as $permission)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" wire:model="selectedPermissions" value="{{ $permission->name }}" id="perm_{{ $permission->id }}">
                            <label class="form-check-label" for="perm_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">No permissions seeded in database yet. Run `php artisan db:seed` or create them.</p>
                    @endforelse
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save Role</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </x-backend.ui.offcanvas>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-offcanvas-role', () => {
                const offcanvasEl = document.getElementById('offcanvasRole');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if(offcanvas) offcanvas.hide();
            });
            Livewire.on('open-offcanvas-role', () => {
                const offcanvasEl = document.getElementById('offcanvasRole');
                const offcanvas = new bootstrap.Offcanvas(offcanvasEl);
                offcanvas.show();
            });
            Livewire.on('swal:error', (data) => {
                Swal.fire({
                    icon: 'error',
                    title: data[0].title,
                    text: data[0].text,
                });
            });
        });
    </script>
</div>
