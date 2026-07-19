<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Profile</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
                </ul>
                <div class="card mb-4 shadow-sm border-0">
                    <h5 class="card-header border-bottom">Profile Details</h5>
                    <div class="card-body mt-3">
                        <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&background=random" alt="user-avatar" class="d-block rounded" height="100" width="100">
                            <div class="button-wrapper">
                                <p class="text-muted mb-0">Your avatar is automatically generated based on your name.</p>
                            </div>
                        </div>

                        <form wire:submit.prevent="updateProfile">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input class="form-control" type="text" wire:model="name" autofocus />
                                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input class="form-control" type="email" wire:model="email" />
                                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="updateProfile">Save changes</span>
                                    <span wire:loading wire:target="updateProfile">Saving...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <h5 class="card-header border-bottom">Change Password</h5>
                    <div class="card-body mt-3">
                        <form wire:submit.prevent="updatePassword">
                            <div class="row g-3">
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Current Password</label>
                                    <input class="form-control" type="password" wire:model="current_password" />
                                    @error('current_password') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">New Password</label>
                                    <input class="form-control" type="password" wire:model="new_password" />
                                    @error('new_password') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm New Password</label>
                                    <input class="form-control" type="password" wire:model="new_password_confirmation" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="updatePassword">Update Password</span>
                                    <span wire:loading wire:target="updatePassword">Updating...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal:success', (data) => {
                Swal.fire({
                    icon: 'success',
                    title: data[0].title,
                    text: data[0].text,
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });
    </script>
</div>
