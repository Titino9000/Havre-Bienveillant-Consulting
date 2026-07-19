<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Manage /</span> Team Members</h4>
            <button class="btn btn-primary" wire:click="resetInputFields" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTeam">
                <i class="bx bx-plus me-1"></i> Add Member
            </button>
        </div>

        <x-backend.ui.card title="Team List">
            <x-backend.ui.table :headers="['Photo', 'Name', 'Role', 'Order', 'Actions']">
                @forelse($teamMembers as $member)
                    <tr>
                        <td>
                            @if($member->image)
                                <img src="{{ Str::startsWith($member->image, 'http') ? $member->image : Storage::url($member->image) }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}" class="rounded-circle" style="width: 40px; height: 40px;">
                            @endif
                        </td>
                        <td class="fw-bold">{{ $member->name }}</td>
                        <td>{{ $member->role_en }}</td>
                        <td>{{ $member->order }}</td>
                        <td>
                            <button wire:click="edit({{ $member->id }})" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="Edit">
                                <i class="bx bx-edit"></i>
                            </button>
                            <button wire:click="delete({{ $member->id }})" wire:confirm="Are you sure you want to delete this member?" class="btn btn-sm btn-icon btn-text-danger rounded-pill" title="Delete">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No team members found.</td>
                    </tr>
                @endforelse
            </x-backend.ui.table>
        </x-backend.ui.card>
    </div>

    <!-- Offcanvas Form -->
    <x-backend.ui.offcanvas id="offcanvasTeam" title="{{ $isEditMode ? 'Edit Team Member' : 'Add New Member' }}">
        <form wire:submit.prevent="store">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" wire:model="name" class="form-control" required>
            </div>

            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#team-en">English</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#team-fr">French</button>
                    </li>
                </ul>
                <div class="tab-content border-0 shadow-none p-3 mb-0">
                    <div class="tab-pane fade show active" id="team-en" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Role (EN)</label>
                            <input type="text" wire:model="role_en" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio (EN)</label>
                            <textarea wire:model="bio_en" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="team-fr" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Role (FR)</label>
                            <input type="text" wire:model="role_fr" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio (FR)</label>
                            <textarea wire:model="bio_fr" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Display Order</label>
                    <input type="number" wire:model="order" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Photo</label>
                    <input type="file" wire:model="newImage" class="form-control" accept="image/*">
                    @if ($newImage)
                        <div class="mt-2"><img src="{{ $newImage->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 100px;"></div>
                    @elseif($image)
                        <div class="mt-2"><img src="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}" class="img-fluid rounded" style="max-height: 100px;"></div>
                    @endif
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save Member</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </x-backend.ui.offcanvas>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-offcanvas-team', () => {
                const offcanvasEl = document.getElementById('offcanvasTeam');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if(offcanvas) offcanvas.hide();
            });
            Livewire.on('open-offcanvas-team', () => {
                const offcanvasEl = document.getElementById('offcanvasTeam');
                const offcanvas = new bootstrap.Offcanvas(offcanvasEl);
                offcanvas.show();
            });
        });
    </script>
</div>
