<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Manage /</span> FAQs</h4>
            <button class="btn btn-primary" wire:click="resetInputFields" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFaq">
                <i class="bx bx-plus me-1"></i> Add FAQ
            </button>
        </div>

        <x-backend.ui.card title="FAQs List">
            <x-backend.ui.table :headers="['Question', 'Answer Preview', 'Status', 'Order', 'Actions']">
                @forelse($faqs as $faq)
                    <tr>
                        <td class="fw-bold">{{ Str::limit($faq->question, 40) }}</td>
                        <td class="text-muted">{{ Str::limit($faq->answer, 40) }}</td>
                        <td>
                            <span class="badge bg-label-{{ $faq->is_active ? 'success' : 'danger' }}">
                                {{ $faq->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $faq->order }}</td>
                        <td>
                            <button wire:click="edit({{ $faq->id }})" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="Edit">
                                <i class="bx bx-edit"></i>
                            </button>
                            <button wire:click="delete({{ $faq->id }})" wire:confirm="Are you sure you want to delete this FAQ?" class="btn btn-sm btn-icon btn-text-danger rounded-pill" title="Delete">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No FAQs found.</td>
                    </tr>
                @endforelse
            </x-backend.ui.table>
        </x-backend.ui.card>
    </div>

    <!-- Offcanvas Form -->
    <x-backend.ui.offcanvas id="offcanvasFaq" title="{{ $isEditMode ? 'Edit FAQ' : 'Add New FAQ' }}">
        <form wire:submit.prevent="store">
            <div class="mb-3">
                <label class="form-label">Question</label>
                <input type="text" wire:model="question" class="form-control" placeholder="Enter question">
                @error('question') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Answer</label>
                <textarea wire:model="answer" class="form-control" rows="5" placeholder="Enter answer"></textarea>
                @error('answer') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Order</label>
                    <input type="number" wire:model="order" class="form-control">
                    @error('order') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="faqSwitch" wire:model="is_active">
                        <label class="form-check-label" for="faqSwitch">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save FAQ</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </x-backend.ui.offcanvas>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-offcanvas-faq', () => {
                const offcanvasEl = document.getElementById('offcanvasFaq');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if(offcanvas) offcanvas.hide();
            });
            Livewire.on('open-offcanvas-faq', () => {
                const offcanvasEl = document.getElementById('offcanvasFaq');
                const offcanvas = new bootstrap.Offcanvas(offcanvasEl);
                offcanvas.show();
            });
        });
    </script>
</div>
