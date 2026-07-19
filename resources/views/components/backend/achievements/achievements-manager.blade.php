<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Manage /</span> Achievements</h4>
            <button class="btn btn-primary" wire:click="resetInputFields" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAchievement">
                <i class="bx bx-plus me-1"></i> Add Achievement
            </button>
        </div>

        <x-backend.ui.card title="Achievements List">
            <x-backend.ui.table :headers="['Image', 'Title (EN)', 'Type', 'Actions']">
                @forelse($achievements as $achievement)
                    <tr>
                        <td>
                            @if($achievement->image)
                                <img src="{{ Str::startsWith($achievement->image, 'http') ? $achievement->image : Storage::url($achievement->image) }}" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">
                            @else
                                <span class="badge bg-label-secondary">No image</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $achievement->title_en }}</td>
                        <td><span class="badge bg-label-info text-capitalize">{{ $achievement->type }}</span></td>
                        <td>
                            <button wire:click="edit({{ $achievement->id }})" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="Edit">
                                <i class="bx bx-edit"></i>
                            </button>
                            <button wire:click="delete({{ $achievement->id }})" wire:confirm="Are you sure you want to delete this achievement?" class="btn btn-sm btn-icon btn-text-danger rounded-pill" title="Delete">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No achievements found.</td>
                    </tr>
                @endforelse
            </x-backend.ui.table>
        </x-backend.ui.card>
    </div>

    <!-- Offcanvas Form -->
    <x-backend.ui.offcanvas id="offcanvasAchievement" title="{{ $isEditMode ? 'Edit Achievement' : 'Add New Achievement' }}">
        <form wire:submit.prevent="store">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#ach-en">English</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#ach-fr">French</button>
                    </li>
                </ul>
                <div class="tab-content border-0 shadow-none p-3 mb-0">
                    <div class="tab-pane fade show active" id="ach-en" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Title (EN)</label>
                            <input type="text" wire:model="title_en" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description (EN)</label>
                            <textarea wire:model="description_en" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ach-fr" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Title (FR)</label>
                            <input type="text" wire:model="title_fr" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description (FR)</label>
                            <textarea wire:model="description_fr" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <label class="form-label">Type</label>
                    <select wire:model="type" class="form-select" required>
                        <option value="project">Project</option>
                        <option value="certification">Certification</option>
                        <option value="partner">Partner/Client</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Image</label>
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
                    <span wire:loading.remove>Save Achievement</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </x-backend.ui.offcanvas>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-offcanvas-achievement', () => {
                const offcanvasEl = document.getElementById('offcanvasAchievement');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if(offcanvas) offcanvas.hide();
            });
            Livewire.on('open-offcanvas-achievement', () => {
                const offcanvasEl = document.getElementById('offcanvasAchievement');
                const offcanvas = new bootstrap.Offcanvas(offcanvasEl);
                offcanvas.show();
            });
        });
    </script>
</div>
