<?php

namespace App\Livewire\Backend\Monitoring;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Mail\SystemNotificationMail;
use Illuminate\Support\Facades\Mail;

#[Layout('components.backend.layouts.back-master')]
#[Title('System Health')]
class ManageSystemHealth extends Component
{
    public $stats = [];
    public $logFiles = [];
    public $loading = false;
    public $lastRefresh;
    public $activeTab = 'overview';
    public $notificationThresholds = [
        'disk_usage' => 90, // Percentage
        'memory_usage' => 85, // Percentage
        'database_connection' => false, // Boolean (connected/disconnected)
        'cache_status' => false, // Boolean (working/not working)
    ];
    public $lastHealthNotification;
    
    // Maintenance Mode
    public $maintenanceMode = false;
    public $maintenanceSecret;

    public function mount()
    {
        $this->maintenanceSecret = config('app.maintenance_secret', 'maintenance-bypass-2024');
        $this->maintenanceMode = config('app.maintenance_mode', false) || file_exists(storage_path('framework/.maintenance'));
        
        $this->loadStats();
        $this->lastRefresh = now()->format('Y-m-d H:i:s');
        $this->lastHealthNotification = Cache::get('last_health_notification', null);
    }
    
    public function toggleMaintenanceMode()
    {
        $file = storage_path('framework/.maintenance');
        
        if ($this->maintenanceMode) {
            if (file_exists($file)) {
                unlink($file);
            }
            // Also call artisan up just in case the native one was used
            \Illuminate\Support\Facades\Artisan::call('up');
            
            $this->maintenanceMode = false;
            session()->flash('success', 'Maintenance mode has been disabled. The site is now live.');
        } else {
            // Ensure the admin bypassing this won't be locked out
            session(['maintenance_bypass' => true, 'maintenance_bypass_expires' => now()->addHour()]);
            
            file_put_contents($file, json_encode([
                'secret' => $this->maintenanceSecret,
                'time' => now()->timestamp,
            ]));
            
            $this->maintenanceMode = true;
            session()->flash('warning', 'Maintenance mode has been enabled. Secret bypass: /admin/maintenance-secret/' . $this->maintenanceSecret);
        }
    }

    public function loadStats()
    {
        $this->loading = true;

        $this->stats = Cache::remember('system_health_stats', 60, function () {
            return $this->calculateStats();
        });

        $this->logFiles = $this->getLogStats();
        $this->loading = false;
        $this->lastRefresh = now()->format('Y-m-d H:i:s');

        // Check for health issues and send notifications
        $this->checkHealthIssues();
    }

    /**
     * Check for system health issues and send notifications
     */
    private function checkHealthIssues()
    {
        $issues = [];

        // Check disk usage
        if ($this->stats['server']['disk_usage']['percentage'] >= $this->notificationThresholds['disk_usage']) {
            $issues[] = [
                'type' => 'warning',
                'title' => 'High Disk Usage',
                'description' => 'Disk usage is at ' . $this->stats['server']['disk_usage']['percentage'] . '%',
                'value' => $this->stats['server']['disk_usage']['percentage'],
                'threshold' => $this->notificationThresholds['disk_usage'],
            ];
        }

        // Check memory usage
        $memoryUsage = $this->getMemoryUsagePercentage();
        if ($memoryUsage >= $this->notificationThresholds['memory_usage']) {
            $issues[] = [
                'type' => 'warning',
                'title' => 'High Memory Usage',
                'description' => 'Memory usage is at ' . $memoryUsage . '%',
                'value' => $memoryUsage,
                'threshold' => $this->notificationThresholds['memory_usage'],
            ];
        }

        // Check database connection
        if ($this->stats['database']['status'] !== 'Connected' && $this->stats['database']['status'] !== 'connected') {
            $issues[] = [
                'type' => 'critical',
                'title' => 'Database Connection Issue',
                'description' => 'Database status: ' . $this->stats['database']['status'],
            ];
        }

        // Check cache status
        if ($this->stats['cache']['status'] === 'Failed' || $this->stats['cache']['status'] === 'Error') {
            $issues[] = [
                'type' => 'warning',
                'title' => 'Cache System Issue',
                'description' => 'Cache status: ' . $this->stats['cache']['status'],
            ];
        }

        // Check for large error logs
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            $logSize = filesize($logFile);
            if ($logSize > 50 * 1024 * 1024) { // 50MB
                $issues[] = [
                    'type' => 'warning',
                    'title' => 'Large Error Log File',
                    'description' => 'Error log file is ' . $this->formatBytes($logSize),
                    'value' => $logSize,
                ];
            }
        }

        // Send notification if issues found
        if (!empty($issues) && $this->shouldSendNotification('system_health')) {
            $this->sendHealthNotification($issues);
        }
    }

    /**
     * Send health notification
     */
    private function sendHealthNotification(array $issues)
    {
        try {
            // Check if we've sent a notification recently (last 2 hours)
            $lastNotification = Cache::get('last_health_notification');
            if ($lastNotification && now()->diffInHours($lastNotification) < 2) {
                return; // Avoid spamming
            }

            $criticalIssues = array_filter($issues, fn($issue) => $issue['type'] === 'critical');
            $warningIssues = array_filter($issues, fn($issue) => $issue['type'] === 'warning');

            $notificationType = !empty($criticalIssues) ? 'critical' : 'warning';

            $notificationData = [
                'type' => $notificationType,
                'subject' => 'System Health Issues Detected',
                'message' => count($issues) . ' system health ' . (count($issues) === 1 ? 'issue' : 'issues') . ' detected.',
                'context' => [
                    'total_issues' => count($issues),
                    'critical_issues' => count($criticalIssues),
                    'warning_issues' => count($warningIssues),
                    'issues' => $issues,
                    'system_stats' => [
                        'disk_usage' => $this->stats['server']['disk_usage']['percentage'] . '%',
                        'database_status' => $this->stats['database']['status'],
                        'cache_status' => $this->stats['cache']['status'],
                        'memory_usage' => $this->getMemoryUsagePercentage() . '%',
                    ],
                    'check_url' => route('admin.monitoring.system-health'),
                    'timestamp' => now()->toDateTimeString(),
                ],
            ];

            // Send to system admin
            $adminEmail = config('mail.mail_config.system_notification_email',
                config('mail.from.address'));

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new SystemNotificationMail($notificationData));
            }

            // Update last notification timestamp
            Cache::put('last_health_notification', now(), 120); // 2 hours

            // Log the notification
            \Log::warning('System health notification sent', [
                'issues' => count($issues),
                'type' => $notificationType,
                'recipient' => $adminEmail,
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to send health notification: ' . $e->getMessage());
        }
    }

    /**
     * Get memory usage percentage
     */
    private function getMemoryUsagePercentage(): float
    {
        try {
            $memoryUsage = memory_get_usage(true);
            $memoryLimit = ini_get('memory_limit');

            if ($memoryLimit === '-1') return 0; // No limit

            $limitBytes = $this->convertToBytes($memoryLimit);
            if ($limitBytes <= 0) return 0;

            return round(($memoryUsage / $limitBytes) * 100, 2);
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Convert memory string to bytes
     */
    private function convertToBytes(string $value): int
    {
        $value = trim($value);
        $last = strtolower($value[strlen($value) - 1]);
        $number = (int) $value;

        switch ($last) {
            case 'g': $number *= 1024 * 1024 * 1024; break;
            case 'm': $number *= 1024 * 1024; break;
            case 'k': $number *= 1024; break;
        }

        return $number;
    }

    public function refreshStats()
    {
        Cache::forget('system_health_stats');
        $this->loadStats();

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Stats refreshed successfully!'
        ]);
    }

    public function clearOldLogs()
    {
        try {
            $deleted404 = 0;
            $deletedFiles = 0;
            $deletedFilesList = [];

            // Clear old 404 logs
            if (class_exists(\App\Models\NotFoundLog::class)) {
                $deleted404 = \App\Models\NotFoundLog::where('last_accessed_at', '<', now()->subDays(30))->delete();
            }

            // Clear old log files
            $logPath = storage_path('logs');
            $cutoff = now()->subDays(7)->timestamp;

            if (is_dir($logPath)) {
                foreach (scandir($logPath) as $file) {
                    if (str_ends_with($file, '.log') && $file !== 'laravel.log') {
                        $filePath = $logPath . '/' . $file;
                        if (filemtime($filePath) < $cutoff) {
                            @unlink($filePath);
                            $deletedFiles++;
                            $deletedFilesList[] = $file;
                        }
                    }
                }
            }

            $this->refreshStats();

            // Send notification if files were deleted
            if ($deletedFiles > 0 || $deleted404 > 0) {
                $this->sendLogCleanupNotification($deleted404, $deletedFiles, $deletedFilesList);
            }

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => "Cleared {$deleted404} old 404 logs and {$deletedFiles} log files"
            ]);

        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to clear logs: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Send log cleanup notification
     */
    private function sendLogCleanupNotification($deleted404, $deletedFiles, $deletedFilesList)
    {
        try {
            $notificationData = [
                'type' => 'info',
                'subject' => 'System Logs Cleanup Completed',
                'message' => 'System maintenance: Old log files have been cleaned up.',
                'context' => [
                    '404_logs_deleted' => $deleted404,
                    'log_files_deleted' => $deletedFiles,
                    'files_list' => array_slice($deletedFilesList, 0, 10), // First 10 files
                    'total_files' => count($deletedFilesList),
                    'cleanup_date' => now()->toDateString(),
                    'action_by' => auth()->user()->name ?? 'System',
                    'timestamp' => now()->toDateTimeString(),
                ],
            ];

            $adminEmail = config('mail.mail_config.system_notification_email',
                config('mail.from.address'));

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new SystemNotificationMail($notificationData));
            }

        } catch (\Exception $e) {
            \Log::error('Failed to send log cleanup notification: ' . $e->getMessage());
        }
    }

    /**
     * Manual health check with notification
     */
    public function manualHealthCheck()
    {
        $this->loading = true;

        // Force refresh
        Cache::forget('system_health_stats');
        $this->loadStats();

        // Send manual check notification
        $this->sendManualHealthCheckNotification();

        $this->loading = false;

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Manual health check completed and notification sent'
        ]);
    }

    /**
     * Send manual health check notification
     */
    private function sendManualHealthCheckNotification()
    {
        try {
            $notificationData = [
                'type' => 'info',
                'subject' => 'Manual System Health Check',
                'message' => 'A manual system health check has been performed.',
                'context' => [
                    'initiated_by' => auth()->user()->name ?? 'Admin',
                    'check_time' => now()->toDateTimeString(),
                    'system_status' => [
                        'disk_usage' => $this->stats['server']['disk_usage']['percentage'] . '%',
                        'database' => $this->stats['database']['status'],
                        'cache' => $this->stats['cache']['status'],
                        'memory' => $this->getMemoryUsagePercentage() . '%',
                        'php_version' => $this->stats['server']['php_version'],
                        'laravel_version' => $this->stats['server']['laravel_version'],
                    ],
                    'details_url' => route('admin.monitoring.system-health'),
                ],
            ];

            $adminEmail = config('mail.mail_config.system_notification_email',
                config('mail.from.address'));

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new SystemNotificationMail($notificationData));
            }

        } catch (\Exception $e) {
            \Log::error('Failed to send manual health check notification: ' . $e->getMessage());
        }
    }

    /**
     * Test notification method
     */
    public function testNotification()
    {
        try {
            $notificationData = [
                'type' => 'info',
                'subject' => 'Test System Health Notification',
                'message' => 'This is a test notification from the System Health monitor.',
                'context' => [
                    'test' => true,
                    'component' => 'System Health Monitor',
                    'timestamp' => now()->toDateTimeString(),
                    'current_stats' => [
                        'disk_usage' => $this->stats['server']['disk_usage']['percentage'] . '%',
                        'database_tables' => $this->stats['database']['table_count'],
                        'cache_status' => $this->stats['cache']['status'],
                    ],
                ],
            ];

            $adminEmail = config('mail.mail_config.system_notification_email',
                config('mail.from.address'));

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new SystemNotificationMail($notificationData));

                $this->dispatch('notify', [
                    'type' => 'success',
                    'message' => 'Test notification sent to ' . $adminEmail
                ]);
            } else {
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'No admin email configured'
                ]);
            }

        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to send test: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Check if notification should be sent based on config
     */
    private function shouldSendNotification($type)
    {
        return config("mail.mail_config.notifications.{$type}", true);
    }

    // ... Keep all the existing methods (calculateStats, getServerStats, getDatabaseStats, etc.)
    // ... They remain the same as in your original code

    protected function calculateStats()
    {
        return [
            'server' => $this->getServerStats(),
            'database' => $this->getDatabaseStats(),
            'application' => $this->getApplicationStats(),
            'errors' => $this->getErrorStats(),
            'cache' => $this->getCacheStats(),
        ];
    }

    protected function getServerStats()
    {
        return [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
            'uptime' => $this->getUptime(),
            'memory_usage' => $this->formatBytes(memory_get_usage(true)),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time') . 's',
            'disk_usage' => $this->getDiskUsage(),
        ];
    }

    protected function getDatabaseStats()
    {
        try {
            $connection = config('database.default');
            $database = config("database.connections.{$connection}.database");

            $tables = DB::select('SHOW TABLES');
            $tableCount = count($tables);

            $size = 0;
            foreach ($tables as $table) {
                $tableName = reset($table);
                $result = DB::select("SELECT data_length + index_length as size FROM information_schema.TABLES WHERE table_schema = ? AND table_name = ?", [$database, $tableName]);
                if ($result) {
                    $size += $result[0]->size;
                }
            }

            return [
                'connection' => $connection,
                'table_count' => $tableCount,
                'size' => $this->formatBytes($size),
                'status' => 'Connected',
            ];
        } catch (\Exception $e) {
            return [
                'connection' => 'N/A',
                'table_count' => 0,
                'size' => 'N/A',
                'status' => 'Error: ' . $e->getMessage(),
            ];
        }
    }

    protected function getApplicationStats()
    {
        return [
            'environment' => app()->environment(),
            'debug_mode' => config('app.debug') ? 'Enabled' : 'Disabled',
            'maintenance_mode' => app()->isDownForMaintenance() ? 'Yes' : 'No',
            'cache_driver' => config('cache.default'),
            'session_driver' => config('session.driver'),
            'queue_driver' => config('queue.default'),
            'timezone' => config('app.timezone'),
            'locale' => config('app.locale'),
        ];
    }

    protected function getErrorStats()
    {
        $stats = [
            'total_404' => 0,
            'today_404' => 0,
            'log_size' => '0 B',
            'error_log_exists' => false,
        ];

        if (class_exists(\App\Models\NotFoundLog::class)) {
            $stats['total_404'] = \App\Models\NotFoundLog::count();
            $stats['today_404'] = \App\Models\NotFoundLog::whereDate('created_at', today())->count();
        }

        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            $stats['log_size'] = $this->formatBytes(filesize($logFile));
            $stats['error_log_exists'] = true;
        }

        return $stats;
    }

    protected function getCacheStats()
    {
        try {
            $key = 'health_check_' . time();
            Cache::put($key, 'test', 10);
            $value = Cache::get($key);
            Cache::forget($key);

            return [
                'status' => $value === 'test' ? 'Working' : 'Failed',
                'driver' => config('cache.default'),
                'prefix' => config('cache.prefix'),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'Error',
                'driver' => config('cache.default'),
                'prefix' => config('cache.prefix'),
            ];
        }
    }

    protected function getLogStats()
    {
        $logPath = storage_path('logs');
        $files = [];

        if (is_dir($logPath)) {
            foreach (scandir($logPath) as $file) {
                if (str_ends_with($file, '.log')) {
                    $filePath = $logPath . '/' . $file;
                    if (file_exists($filePath)) {
                        $size = filesize($filePath);
                        $modified = filemtime($filePath);

                        $files[] = [
                            'name' => $file,
                            'size' => $this->formatBytes($size),
                            'raw_size' => $size,
                            'modified' => date('Y-m-d H:i:s', $modified),
                            'modified_human' => \Carbon\Carbon::createFromTimestamp($modified)->diffForHumans(),
                            'lines' => $this->countLines($filePath),
                        ];
                    }
                }
            }
        }

        // Sort by size (largest first)
        usort($files, function($a, $b) {
            return $b['raw_size'] - $a['raw_size'];
        });

        return $files;
    }

    protected function countLines($filePath)
    {
        if (!file_exists($filePath)) return 0;

        $file = fopen($filePath, 'r');
        $lines = 0;

        while (!feof($file)) {
            fgets($file);
            $lines++;
        }

        fclose($file);
        return $lines;
    }

    protected function getDiskUsage()
    {
        try {
            $total = disk_total_space(base_path());
            $free = disk_free_space(base_path());
            $used = $total - $free;
            $percentage = $total > 0 ? round(($used / $total) * 100, 2) : 0;

            return [
                'total' => $this->formatBytes($total),
                'used' => $this->formatBytes($used),
                'free' => $this->formatBytes($free),
                'percentage' => $percentage,
                'status' => $this->getUsageStatus($percentage),
            ];
        } catch (\Exception $e) {
            return [
                'total' => 'N/A',
                'used' => 'N/A',
                'free' => 'N/A',
                'percentage' => 0,
                'status' => 'secondary',
            ];
        }
    }

    protected function getUptime()
    {
        try {
            if (function_exists('sys_getloadavg')) {
                $load = sys_getloadavg();
                return "Load: " . implode(', ', array_map(fn($val) => round($val, 2), $load));
            }
            return "N/A";
        } catch (\Exception $e) {
            return "N/A";
        }
    }

    protected function getUsageStatus($percentage)
    {
        if ($percentage >= 90) return 'danger';
        if ($percentage >= 75) return 'warning';
        if ($percentage >= 50) return 'info';
        return 'success';
    }

    protected function formatBytes($bytes, $precision = 2)
    {
        if ($bytes <= 0) return '0 B';

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function downloadLog($filename)
    {
        $path = storage_path('logs/' . $filename);

        if (!file_exists($path)) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Log file not found'
            ]);
            return;
        }

        return response()->download($path);
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.backend.monitoring.manage-system-health');
    }
}
