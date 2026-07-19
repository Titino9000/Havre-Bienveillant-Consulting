<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Manage /</span> Sliders</h4>
            <button class="btn btn-primary" wire:click="resetInputFields" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSlider">
                <i class="bx bx-plus me-1"></i> Add Slider
            </button>
        </div>

        <x-backend.ui.card title="Sliders List">
            <x-backend.ui.table :headers="['Image', 'Title', 'Status', 'Order', 'Actions']">
                @forelse($sliders as $slider)
                    <tr>
                        <td>
                            <img src="{{ Storage::url($slider->image_path) }}" alt="Slider" class="rounded" style="width: 80px; height: 50px; object-fit: cover;">
                        </td>
                        <td class="fw-bold">{{ $slider->title ?: 'No Title' }}</td>
                        <td>
                            <span class="badge bg-label-{{ $slider->is_active ? 'success' : 'danger' }}">
                                {{ $slider->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $slider->order }}</td>
                        <td>
                            <button wire:click="edit({{ $slider->id }})" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="Edit">
                                <i class="bx bx-edit"></i>
                            </button>
                            <button wire:click="delete({{ $slider->id }})" wire:confirm="Are you sure you want to delete this slider?" class="btn btn-sm btn-icon btn-text-danger rounded-pill" title="Delete">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No sliders found.</td>
                    </tr>
                @endforelse
            </x-backend.ui.table>
        </x-backend.ui.card>
    </div>

    <!-- Offcanvas Form -->
    <x-backend.ui.offcanvas id="offcanvasSlider" title="{{ $isEditMode ? 'Edit Slider' : 'Add New Slider' }}">
        <form wire:submit.prevent="store">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" wire:model="title" class="form-control" placeholder="Enter title">
                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Subtitle</label>
                <textarea wire:model="subtitle" class="form-control" rows="3" placeholder="Enter subtitle"></textarea>
                @error('subtitle') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" wire:model="newImage" class="form-control" accept="image/*">
                @error('newImage') <span class="text-danger small">{{ $message }}</span> @enderror
                
                @if ($newImage)
                    <div class="mt-2"><img src="{{ $newImage->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 150px;"></div>
                @elseif($image_path)
                    <div class="mt-2"><img src="{{ Storage::url($image_path) }}" class="img-fluid rounded" style="max-height: 150px;"></div>
                @endif
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Order</label>
                    <input type="number" wire:model="order" class="form-control">
                    @error('order') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="is_active">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save Slider</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </x-backend.ui.offcanvas>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-offcanvas', () => {
                const offcanvasEl = document.getElementById('offcanvasSlider');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if(offcanvas) offcanvas.hide();
            });
            Livewire.on('open-offcanvas', () => {
                const offcanvasEl = document.getElementById('offcanvasSlider');
                const offcanvas = new bootstrap.Offcanvas(offcanvasEl);
                offcanvas.show();
            });
            Livewire.on('swal:success', (data) => {
                Swal.fire({
                    icon: 'success',
                    title: data[0].title,
                    text: data[0].text,
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
</div>
