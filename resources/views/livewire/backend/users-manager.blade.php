<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Manage /</span> Users</h4>
            <button class="btn btn-primary" wire:click="resetInputFields" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUser">
                <i class="bx bx-plus me-1"></i> Add User
            </button>
        </div>

        <x-backend.ui.card title="Users List">
            <x-backend.ui.table :headers="['Avatar', 'Name', 'Email', 'Roles', 'Joined', 'Actions']">
                @forelse($users as $user)
                    <tr>
                        <td>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                        </td>
                        <td class="fw-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @forelse($user->roles as $role)
                                <span class="badge bg-label-info">{{ $role->name }}</span>
                            @empty
                                <span class="text-muted small">No roles</span>
                            @endforelse
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <button wire:click="edit({{ $user->id }})" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="Edit">
                                <i class="bx bx-edit"></i>
                            </button>
                            @if(auth()->id() != $user->id)
                                <button wire:click="delete({{ $user->id }})" wire:confirm="Are you sure you want to delete this user?" class="btn btn-sm btn-icon btn-text-danger rounded-pill" title="Delete">
                                    <i class="bx bx-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No users found.</td>
                    </tr>
                @endforelse
            </x-backend.ui.table>
        </x-backend.ui.card>
    </div>

    <!-- Offcanvas Form -->
    <x-backend.ui.offcanvas id="offcanvasUser" title="{{ $isEditMode ? 'Edit User' : 'Add New User' }}">
        <form wire:submit.prevent="store">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" wire:model="name" class="form-control" placeholder="John Doe">
                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" wire:model="email" class="form-control" placeholder="john@example.com">
                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" wire:model="password" class="form-control" placeholder="{{ $isEditMode ? 'Leave blank to keep current' : 'Enter password' }}">
                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Roles</label>
                <div class="border rounded p-3">
                    @forelse($allRoles as $role)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" wire:model="selectedRoles" value="{{ $role->name }}" id="role_{{ $role->id }}">
                            <label class="form-check-label" for="role_{{ $role->id }}">
                                {{ ucfirst($role->name) }}
                            </label>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">No roles available. Please create roles first.</p>
                    @endforelse
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save User</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </x-backend.ui.offcanvas>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-offcanvas-user', () => {
                const offcanvasEl = document.getElementById('offcanvasUser');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if(offcanvas) offcanvas.hide();
            });
            Livewire.on('open-offcanvas-user', () => {
                const offcanvasEl = document.getElementById('offcanvasUser');
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
