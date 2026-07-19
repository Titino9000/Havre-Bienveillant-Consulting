<div>
    @if($successMessage)
        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
            <i class="bx bx-check-circle fs-4 me-2"></i>
            <div>{{ $successMessage }}</div>
        </div>
    @endif

    <form wire:submit.prevent="submit" class="needs-validation">
        <div class="row gy-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nom complet <span class="text-danger">*</span></label>
                <input type="text" wire:model="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Votre nom">
                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Adresse Email <span class="text-danger">*</span></label>
                <input type="email" wire:model="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="votre@email.com">
                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Téléphone</label>
                <input type="text" wire:model="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" placeholder="+250 788 000 000">
                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Sujet</label>
                <input type="text" wire:model="subject" class="form-control form-control-lg @error('subject') is-invalid @enderror" placeholder="Sujet de votre message">
                @error('subject') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-12">
                <label class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                <textarea wire:model="message" class="form-control form-control-lg @error('message') is-invalid @enderror" rows="5" placeholder="Comment pouvons-nous vous aider ?"></textarea>
                @error('message') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-12 mt-4 text-end">
                <button type="submit" class="btn-premium px-5" wire:loading.attr="disabled">
                    <span wire:loading.remove>Envoyer le message</span>
                    <span wire:loading>
                        <i class="bx bx-loader-alt bx-spin me-2"></i> Envoi...
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>
