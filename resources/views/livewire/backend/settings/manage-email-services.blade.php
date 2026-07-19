<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Settings /</span> Email Services
    </h4>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 mb-4">
                <h5 class="card-header border-bottom py-3 fw-bold">Test Email Configuration</h5>
                <div class="card-body pt-3">
                    <p>Send a test email to verify your SMTP settings.</p>
                    <form wire:submit.prevent="sendTestEmail">
                        <div class="mb-3">
                            <label class="form-label">Recipient Email</label>
                            <input type="email" wire:model.defer="recipient_email" class="form-control" placeholder="admin@example.com">
                        </div>
                        <button type="submit" class="btn btn-primary shadow-sm" wire:loading.attr="disabled" wire:target="sendTestEmail">
                            <span wire:loading.remove wire:target="sendTestEmail">Send Test Email</span>
                            <span wire:loading wire:target="sendTestEmail">Sending...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 mb-4">
                <h5 class="card-header border-bottom py-3 fw-bold">Send System Notification</h5>
                <div class="card-body pt-3">
                    <form wire:submit.prevent="sendNotification">
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select wire:model.defer="notification_type" class="form-select">
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="error">Error</option>
                                <option value="critical">Critical</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" wire:model.defer="subject" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea wire:model.defer="message" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning" wire:loading.attr="disabled" wire:target="sendNotification">
                            <span wire:loading.remove wire:target="sendNotification">Send Notification</span>
                            <span wire:loading wire:target="sendNotification">Sending...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
