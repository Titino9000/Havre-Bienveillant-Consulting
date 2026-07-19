<?php

namespace App\Livewire\Backend\Monitoring;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\NotFoundLog;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Mail\SystemNotificationMail;
use Illuminate\Support\Facades\Mail;

#[Layout('components.backend.layouts.back-master')]
#[Title('404 Error Logs')]
class ManageNotFoundLogs extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 20;
    public $sortField = 'hits';
    public $sortDirection = 'desc';
    public $notificationThreshold = 10; // Minimum errors to trigger notification
    public $lastNotificationSent;

    public function mount()
    {
        $this->getDashboardStats();
        $this->lastNotificationSent = Cache::get('last_404_notification', null);
    }

    public function getDashboardStats()
    {
        return Cache::remember('not_found_dashboard_stats', 300, function () {
            if (!class_exists(NotFoundLog::class)) {
                return [
                    'total' => 0,
                    'today' => 0,
                    'week' => 0,
                    'unique' => 0,
                    'trend' => 0
                ];
            }

            $total = NotFoundLog::count();
            $today = NotFoundLog::whereDate('last_accessed_at', today())->count();
            $week = NotFoundLog::where('last_accessed_at', '>', now()->subWeek())->count();
            $unique = NotFoundLog::distinct('url')->count('url');

            $lastWeek = NotFoundLog::whereBetween('last_accessed_at', [now()->subWeek(2), now()->subWeek()])->count();
            $trend = $lastWeek > 0 ? (($week - $lastWeek) / $lastWeek) * 100 : 0;

            // Check if we should send notification
            if ($today >= $this->notificationThreshold && $this->shouldSendNotification('404_errors')) {
                $this->send404Notification($today, $week);
            }

            return [
                'total' => $total,
                'today' => $today,
                'week' => $week,
                'unique' => $unique,
                'trend' => $trend
            ];
        });
    }

    /**
     * Send notification for high 404 errors
     */
    private function send404Notification($todayCount, $weekCount)
    {
        try {
            // Check if we've sent a notification recently (last 24 hours)
            $lastNotification = Cache::get('last_404_notification');
            if ($lastNotification && now()->diffInHours($lastNotification) < 24) {
                return; // Avoid spamming
            }

            // Get top error URLs
            $topErrors = NotFoundLog::select('url')
                ->selectRaw('COUNT(*) as error_count')
                ->whereDate('last_accessed_at', today())
                ->groupBy('url')
                ->orderBy('error_count', 'desc')
                ->limit(5)
                ->get();

            // Prepare notification data
            $notificationData = [
                'type' => 'warning',
                'subject' => 'High 404 Error Rate Detected',
                'message' => "Your website is experiencing a high rate of 404 errors today.",
                'context' => [
                    'today_errors' => $todayCount,
                    'week_errors' => $weekCount,
                    'threshold' => $this->notificationThreshold,
                    'top_errors' => $topErrors->toArray(),
                    'check_url' => route('admin.monitoring.not-found-logs'),
                    'action_required' => $todayCount > 50 ? 'immediate' : 'monitor',
                ],
                'timestamp' => now()->toDateTimeString(),
            ];

            // Send to all admin users
            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->orWhere('is_admin', true)->get();

            foreach ($adminUsers as $user) {
                Mail::to($user->email)->send(new SystemNotificationMail($notificationData));
            }

            // Update last notification timestamp
            Cache::put('last_404_notification', now(), 1440); // 24 hours

            // Log the notification
            \Log::warning('404 error notification sent', [
                'today_errors' => $todayCount,
                'recipients' => $adminUsers->count(),
                'threshold' => $this->notificationThreshold,
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to send 404 notification: ' . $e->getMessage());
        }
    }

    /**
     * Check if notification should be sent based on config
     */
    private function shouldSendNotification($type)
    {
        return config("mail.mail_config.notifications.{$type}", true);
    }

    public function clearOldLogs()
    {
        if (class_exists(NotFoundLog::class)) {
            $deleted = NotFoundLog::where('last_accessed_at', '<', now()->subDays(30))->delete();

            // Clear cached stats
            Cache::forget('not_found_dashboard_stats');

            // Send notification if many logs were cleared
            if ($deleted > 100) {
                $this->sendClearLogsNotification($deleted);
            }

            $this->dispatch('toast', [
                'type' => 'success',
                'message' => "Cleared {$deleted} old logs (30+ days)"
            ]);
        } else {
            $this->dispatch('toast', [
                'type' => 'info',
                'message' => '404 logging is not enabled'
            ]);
        }
    }

    /**
     * Send notification when many logs are cleared
     */
    private function sendClearLogsNotification($deletedCount)
    {
        try {
            $notificationData = [
                'type' => 'info',
                'subject' => 'Old 404 Logs Cleared',
                'message' => "System maintenance: Old 404 error logs have been cleared.",
                'context' => [
                    'logs_cleared' => $deletedCount,
                    'older_than_days' => 30,
                    'timestamp' => now()->toDateTimeString(),
                    'action_by' => auth()->user()->name ?? 'System',
                ],
            ];

            // Send to primary admin
            $adminEmail = config('mail.mail_config.system_notification_email',
                config('mail.from.address'));

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new SystemNotificationMail($notificationData));
            }

        } catch (\Exception $e) {
            \Log::error('Failed to send clear logs notification: ' . $e->getMessage());
        }
    }

    public function deleteLog($id)
    {
        if (class_exists(NotFoundLog::class)) {
            $log = NotFoundLog::find($id);
            $logData = $log->toArray();
            $log->delete();

            // Clear cached stats
            Cache::forget('not_found_dashboard_stats');

            // Send notification for important log deletion
            if ($logData['hits'] > 20) {
                $this->sendLogDeletionNotification($logData);
            }

            $this->dispatch('toast', [
                'type' => 'success',
                'message' => 'Log entry deleted'
            ]);
        }
    }

    /**
     * Send notification when important log is deleted
     */
    private function sendLogDeletionNotification($logData)
    {
        try {
            $notificationData = [
                'type' => 'warning',
                'subject' => 'High-Traffic 404 Log Deleted',
                'message' => "A 404 error log with high traffic has been manually deleted.",
                'context' => [
                    'url' => $logData['url'],
                    'hits' => $logData['hits'],
                    'last_accessed' => $logData['last_accessed_at'],
                    'deleted_by' => auth()->user()->name ?? 'Unknown',
                    'timestamp' => now()->toDateTimeString(),
                ],
            ];

            $adminEmail = config('mail.mail_config.system_notification_email',
                config('mail.from.address'));

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new SystemNotificationMail($notificationData));
            }

        } catch (\Exception $e) {
            \Log::error('Failed to send log deletion notification: ' . $e->getMessage());
        }
    }

    public function exportToCsv()
    {
        if (!class_exists(NotFoundLog::class)) {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => '404 logging is not enabled'
            ]);
            return;
        }

        $logs = NotFoundLog::orderBy('hits', 'desc')->limit(1000)->get();

        $csvContent = "URL,Hits,Last Accessed,Referrer,IP Address\n";
        foreach ($logs as $log) {
            $csvContent .= "\"" . str_replace('"', '""', $log->url) . "\",";
            $csvContent .= $log->hits . ",";
            $csvContent .= $log->last_accessed_at . ",";
            $csvContent .= "\"" . str_replace('"', '""', $log->referrer) . "\",";
            $csvContent .= $log->ip_address . "\n";
        }

        // Send notification about export
        $this->sendExportNotification(count($logs));

        return response()->streamDownload(function () use ($csvContent) {
            echo $csvContent;
        }, '404-errors-' . date('Y-m-d') . '.csv');
    }

    /**
     * Send notification when logs are exported
     */
    private function sendExportNotification($logCount)
    {
        try {
            $notificationData = [
                'type' => 'info',
                'subject' => '404 Logs Exported',
                'message' => "404 error logs have been exported to CSV.",
                'context' => [
                    'log_count' => $logCount,
                    'exported_by' => auth()->user()->name ?? 'Unknown',
                    'timestamp' => now()->toDateTimeString(),
                    'file_name' => '404-errors-' . date('Y-m-d') . '.csv',
                ],
            ];

            $adminEmail = config('mail.mail_config.system_notification_email',
                config('mail.from.address'));

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new SystemNotificationMail($notificationData));
            }

        } catch (\Exception $e) {
            \Log::error('Failed to send export notification: ' . $e->getMessage());
        }
    }

    /**
     * Manual notification test method
     */
    public function testNotification()
    {
        try {
            $notificationData = [
                'type' => 'info',
                'subject' => 'Test System Notification',
                'message' => "This is a test notification from the 404 Error Logs system.",
                'context' => [
                    'test_data' => 'This data is for testing purposes only.',
                    'timestamp' => now()->toDateTimeString(),
                    'triggered_by' => auth()->user()->name ?? 'Test User',
                ],
            ];

            $adminEmail = config('mail.mail_config.system_notification_email',
                config('mail.from.address'));

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new SystemNotificationMail($notificationData));

                $this->dispatch('toast', [
                    'type' => 'success',
                    'message' => 'Test notification sent to ' . $adminEmail
                ]);
            } else {
                $this->dispatch('toast', [
                    'type' => 'error',
                    'message' => 'No admin email configured'
                ]);
            }

        } catch (\Exception $e) {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'Failed to send test: ' . $e->getMessage()
            ]);
        }
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $stats = $this->getDashboardStats();

        return view('livewire.backend.monitoring.manage-not-found-logs', [
            'stats' => $stats
        ]);
    }
}
