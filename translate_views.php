<?php

$sidebarPath = 'resources/views/components/backend/side-menu.blade.php';
$sidebarContent = file_get_contents($sidebarPath);
$sidebarContent = preg_replace_callback('/<div data-i18n="([^"]+)">([^<]+)<\/div>/', function($m) {
    $text = trim($m[2]);
    if (strpos($text, '{{') === false) {
        return '<div data-i18n="'.$m[1].'">{{ __(\''.$text.'\') }}</div>';
    }
    return $m[0];
}, $sidebarContent);
file_put_contents($sidebarPath, $sidebarContent);

$dashboardPath = 'resources/views/components/backend/dashboard.blade.php';
$dashboardContent = file_get_contents($dashboardPath);

$textsToTranslate = [
    'Overview & Activity',
    'Key metrics at a glance',
    'Services',
    'Achievements',
    'Team',
    'Unread',
    'A chart mapping inquiries and engagement will be displayed here.',
    'Inquiries Pipeline',
    'Status of recent leads',
    'Requires action',
    'Total Inquiries',
    'All time',
    'Recent Inquiries',
    'View All',
    'Name',
    'Status',
    'Date',
    'Read',
    'No recent inquiries.',
    'Team Members',
    'Member',
    'Position',
    'No team members added.'
];

foreach ($textsToTranslate as $text) {
    $dashboardContent = str_replace(">".$text."<", ">{{ __('".$text."') }}<", $dashboardContent);
}

file_put_contents($dashboardPath, $dashboardContent);

// Also add to fr.json
$frJsonPath = 'lang/fr.json';
$frJson = json_decode(file_get_contents($frJsonPath), true);

$dashboardTranslations = [
    'Dashboard' => 'Tableau de bord',
    'Blog' => 'Blog',
    'Post' => 'Article',
    'Categories' => 'Catégories',
    'tags' => 'Étiquettes',
    'Projects' => 'Projets',
    'Offerings' => 'Offres',
    'Services' => 'Services',
    'Products' => 'Produits',
    'Solutions' => 'Solutions',
    'Clients' => 'Clients',
    'Users' => 'Utilisateurs',
    'Communication' => 'Communication',
    'Messages' => 'Messages',
    'Newsletters' => 'Newsletters',
    'Monitoring' => 'Surveillance',
    'System Health' => 'Santé du système',
    '404 Logs' => 'Journaux 404',
    'Site Logs' => 'Journaux du site',
    'Homepage Sliders' => 'Bannières d\'accueil',
    'Global Settings' => 'Paramètres globaux',
    'Support' => 'Support',
    'Documentation' => 'Documentation',
    'Overview & Activity' => 'Aperçu & Activité',
    'Key metrics at a glance' => 'Mesures clés en un coup d\'œil',
    'Achievements' => 'Réalisations',
    'Team' => 'Équipe',
    'Unread' => 'Non lu',
    'A chart mapping inquiries and engagement will be displayed here.' => 'Un graphique montrant les demandes et l\'engagement sera affiché ici.',
    'Inquiries Pipeline' => 'Pipeline de Demandes',
    'Status of recent leads' => 'Statut des prospects récents',
    'Requires action' => 'Action requise',
    'Total Inquiries' => 'Total des Demandes',
    'All time' => 'Depuis toujours',
    'Recent Inquiries' => 'Demandes Récentes',
    'View All' => 'Voir Tout',
    'Name' => 'Nom',
    'Status' => 'Statut',
    'Date' => 'Date',
    'Read' => 'Lu',
    'No recent inquiries.' => 'Aucune demande récente.',
    'Team Members' => 'Membres de l\'équipe',
    'Member' => 'Membre',
    'Position' => 'Position',
    'No team members added.' => 'Aucun membre d\'équipe ajouté.'
];

foreach ($dashboardTranslations as $en => $fr) {
    if (!isset($frJson[$en])) {
        $frJson[$en] = $fr;
    }
}

file_put_contents($frJsonPath, json_encode($frJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Done";
