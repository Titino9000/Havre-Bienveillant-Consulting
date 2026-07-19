<?php

$sidebarPath = 'resources/views/components/backend/side-menu.blade.php';
$sidebarContent = file_get_contents($sidebarPath);
$sidebarContent = preg_replace('/ data-i18n="[^"]+"/', '', $sidebarContent);
$sidebarContent = str_replace(
    ['<div>Monitoring</div>', '<div>System Health</div>', '<div>404 Logs</div>', '<div>Site Logs</div>'], 
    ['<div>{{ __(\'Monitoring\') }}</div>', '<div>{{ __(\'System Health\') }}</div>', '<div>{{ __(\'404 Logs\') }}</div>', '<div>{{ __(\'Site Logs\') }}</div>'], 
    $sidebarContent
);
file_put_contents($sidebarPath, $sidebarContent);

// Also remove from backend-header if it has any data-i18n
$headerPath = 'resources/views/components/backend/backend-header.blade.php';
if (file_exists($headerPath)) {
    $headerContent = file_get_contents($headerPath);
    $headerContent = preg_replace('/ data-i18n="[^"]+"/', '', $headerContent);
    file_put_contents($headerPath, $headerContent);
}

echo "data-i18n removed.";
