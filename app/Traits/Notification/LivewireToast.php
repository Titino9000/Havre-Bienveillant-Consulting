<?php
namespace App\Traits\Notification;

trait LivewireToast
{
    protected function toastNotification(
        string $message,
        string $type = 'success',
        string $title = 'Notification',
        string $placement = 'bottom-end',
        int $duration = 3000
    ): void {
        $this->dispatch('livewire-toast',
            type : $type,
            title : $title,
            message : $message,
            placement : $placement,
            duration : $duration
        );
    }
}
