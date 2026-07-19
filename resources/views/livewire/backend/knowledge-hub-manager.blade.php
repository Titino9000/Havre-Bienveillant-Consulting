<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Manage /</span> Knowledge Hub</h4>
            <button class="btn btn-primary" wire:click="resetInputFields" data-bs-toggle="offcanvas" data-bs-target="#offcanvasHub">
                <i class="bx bx-plus me-1"></i> Add Resource
            </button>
        </div>

        <x-backend.ui.card title="Resources List">
            <x-backend.ui.table :headers="['Cover', 'Title', 'Type', 'Status', 'Actions']">
                @forelse($hubs as $hub)
                    <tr>
                        <td>
                            @if($hub->image_path)
                                <img src="{{ Storage::url($hub->image_path) }}" alt="Cover" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                    <i class="bx {{ $hub->type == 'pdf' ? 'bxs-file-pdf text-danger' : 'bx-file text-primary' }} fs-4"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold">{{ Str::limit($hub->title, 40) }}</td>
                        <td>
                            <span class="badge bg-label-{{ $hub->type == 'pdf' ? 'danger' : 'primary' }}">
                                {{ strtoupper($hub->type) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-label-{{ $hub->is_active ? 'success' : 'secondary' }}">
                                {{ $hub->is_active ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td>
                            <button wire:click="edit({{ $hub->id }})" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="Edit">
                                <i class="bx bx-edit"></i>
                            </button>
                            <button wire:click="delete({{ $hub->id }})" wire:confirm="Are you sure you want to delete this resource?" class="btn btn-sm btn-icon btn-text-danger rounded-pill" title="Delete">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No resources found.</td>
                    </tr>
                @endforelse
            </x-backend.ui.table>
        </x-backend.ui.card>
    </div>

    <!-- Offcanvas Form -->
    <x-backend.ui.offcanvas id="offcanvasHub" title="{{ $isEditMode ? 'Edit Resource' : 'Add New Resource' }}">
        <form wire:submit.prevent="store">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" wire:model="title" class="form-control" placeholder="Enter title">
                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Type</label>
                    <select wire:model.live="type" class="form-select">
                        <option value="article">Article</option>
                        <option value="pdf">PDF Download</option>
                    </select>
                    @error('type') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="hubSwitch" wire:model="is_active">
                        <label class="form-check-label" for="hubSwitch">Published</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Cover Image <span class="text-muted">(Optional)</span></label>
                <input type="file" wire:model="newImage" class="form-control" accept="image/*">
                @error('newImage') <span class="text-danger small">{{ $message }}</span> @enderror
                @if ($newImage)
                    <div class="mt-2"><img src="{{ $newImage->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 100px;"></div>
                @elseif($image_path)
                    <div class="mt-2"><img src="{{ Storage::url($image_path) }}" class="img-fluid rounded" style="max-height: 100px;"></div>
                @endif
            </div>

            @if($type === 'article')
                <div class="mb-3">
                    <label class="form-label">Article Content</label>
                    <textarea wire:model="content" class="form-control" rows="8" placeholder="Write your article here..."></textarea>
                    @error('content') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            @else
                <div class="mb-3">
                    <label class="form-label">PDF File</label>
                    <input type="file" wire:model="newFile" class="form-control" accept="application/pdf">
                    @error('newFile') <span class="text-danger small">{{ $message }}</span> @enderror
                    @if($file_path && !$newFile)
                        <div class="mt-2 text-success small"><i class="bx bxs-file-pdf"></i> Current file uploaded.</div>
                    @endif
                </div>
            @endif

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save Resource</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </x-backend.ui.offcanvas>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-offcanvas-hub', () => {
                const offcanvasEl = document.getElementById('offcanvasHub');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if(offcanvas) offcanvas.hide();
            });
            Livewire.on('open-offcanvas-hub', () => {
                const offcanvasEl = document.getElementById('offcanvasHub');
                const offcanvas = new bootstrap.Offcanvas(offcanvasEl);
                offcanvas.show();
            });
        });
    </script>
</div>
