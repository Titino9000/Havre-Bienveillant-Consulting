<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Manage /</span> Services</h4>
            <button class="btn btn-primary" wire:click="resetInputFields" data-bs-toggle="offcanvas" data-bs-target="#offcanvasService">
                <i class="bx bx-plus me-1"></i> Add Service
            </button>
        </div>

        <x-backend.ui.card title="Services List">
            <x-backend.ui.table :headers="['Title (EN)', 'Type', 'Actions']">
                @forelse($services as $service)
                    <tr>
                        <td class="fw-bold">{{ $service->title_en }}</td>
                        <td><span class="badge bg-label-primary text-capitalize">{{ $service->type }}</span></td>
                        <td>
                            <button wire:click="edit({{ $service->id }})" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="Edit">
                                <i class="bx bx-edit"></i>
                            </button>
                            <button wire:click="delete({{ $service->id }})" wire:confirm="Are you sure you want to delete this service?" class="btn btn-sm btn-icon btn-text-danger rounded-pill" title="Delete">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">No services found.</td>
                    </tr>
                @endforelse
            </x-backend.ui.table>
        </x-backend.ui.card>
    </div>

    <!-- Offcanvas Form -->
    <x-backend.ui.offcanvas id="offcanvasService" title="{{ $isEditMode ? 'Edit Service' : 'Add New Service' }}">
        <form wire:submit.prevent="store">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-en">English</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-fr">French</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-settings">Settings</button>
                    </li>
                </ul>
                <div class="tab-content border-0 shadow-none p-3 mb-0">
                    <!-- English Tab -->
                    <div class="tab-pane fade show active" id="navs-en" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Title (EN)</label>
                            <input type="text" wire:model="title_en" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subtitle (EN)</label>
                            <input type="text" wire:model="subtitle_en" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Overview (EN)</label>
                            <textarea wire:model="description_en" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Audiences (EN) - Line separated</label>
                            <textarea wire:model="audiences_en" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Features (EN) - Line separated</label>
                            <textarea wire:model="features_en" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Benefits (EN) - Line separated</label>
                            <textarea wire:model="benefits_en" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CTA Text (EN)</label>
                            <input type="text" wire:model="cta_text_en" class="form-control">
                        </div>
                    </div>

                    <!-- French Tab -->
                    <div class="tab-pane fade" id="navs-fr" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Title (FR)</label>
                            <input type="text" wire:model="title_fr" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subtitle (FR)</label>
                            <input type="text" wire:model="subtitle_fr" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Overview (FR)</label>
                            <textarea wire:model="description_fr" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Audiences (FR) - Line separated</label>
                            <textarea wire:model="audiences_fr" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Features (FR) - Line separated</label>
                            <textarea wire:model="features_fr" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Benefits (FR) - Line separated</label>
                            <textarea wire:model="benefits_fr" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CTA Text (FR)</label>
                            <input type="text" wire:model="cta_text_fr" class="form-control">
                        </div>
                    </div>

                    <!-- Settings Tab -->
                    <div class="tab-pane fade" id="navs-settings" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Service Type</label>
                            <select wire:model="type" class="form-select" required>
                                <option value="counseling">Counseling</option>
                                <option value="workshop">Workshop</option>
                                <option value="consulting">Consulting</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon Class</label>
                            <input type="text" wire:model="icon" class="form-control" placeholder="e.g., bx bx-heart">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save Service</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </x-backend.ui.offcanvas>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-offcanvas-service', () => {
                const offcanvasEl = document.getElementById('offcanvasService');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if(offcanvas) offcanvas.hide();
            });
            Livewire.on('open-offcanvas-service', () => {
                const offcanvasEl = document.getElementById('offcanvasService');
                const offcanvas = new bootstrap.Offcanvas(offcanvasEl);
                offcanvas.show();
            });
        });
    </script>
</div>
