<?php

namespace App\Livewire\Backend\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Services\Contacts\Interfaces\MailServiceInterface;
use App\Traits\Notification\LivewireToast;

#[Layout('components.backend.layouts.back-master')]
#[Title('Email Services')]
class ManageEmailServicesPage extends Component
{
    use LivewireToast;

    public string $recipient_email = '';
    public string $subject = '';
    public string $notification_type = 'info';
    public string $message = '';
    
    public bool $isSending = false;

    protected $rules = [
        'recipient_email' => 'nullable|email',
        'subject' => 'required|string|max:255',
        'notification_type' => 'required|in:info,warning,error,critical',
        'message' => 'required|string',
    ];

    public function mount()
    {
        $this->recipient_email = config('mailService.system_notification_email') ?? config('mail.from.address');
    }

    public function sendNotification(MailServiceInterface $mailService)
    {
        $this->validate();
        
        $this->isSending = true;

        $success = $mailService->sendSystemNotification(
            type: $this->notification_type,
            subject: $this->subject,
            data: ['message' => $this->message],
            to: $this->recipient_email ?: null
        );

        $this->isSending = false;

        if ($success) {
            $this->toastNotification('System notification sent successfully!', 'success');
            $this->reset(['subject', 'message']);
            $this->notification_type = 'info';
        } else {
            $this->toastNotification('Failed to send notification. Check logs.', 'error');
        }
    }

    public function sendTestEmail(MailServiceInterface $mailService)
    {
        $this->isSending = true;
        
        $to = $this->recipient_email ?: config('mail.from.address');
        $success = $mailService->sendTestEmail($to);
        
        $this->isSending = false;

        if ($success) {
            $this->toastNotification('Test email sent successfully to ' . $to, 'success');
        } else {
            $this->toastNotification('Failed to send test email. Check SMTP settings.', 'error');
        }
    }

    public function render()
    {
        return view('livewire.backend.settings.manage-email-services');
    }
}
