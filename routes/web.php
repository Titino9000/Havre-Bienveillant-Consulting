<?php

use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', function () {
    $services = \App\Models\Service::limit(6)->get();
    $sliders = \App\Models\Slider::where('is_active', true)->orderBy('order')->get();
    return view('frontend.home', compact('services', 'sliders'));
})->name('home');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/services', function () {
    $services = \App\Models\Service::all();
    return view('frontend.services', compact('services'));
})->name('services');

Route::get('/achievements', function () {
    return view('frontend.achievements');
})->name('achievements');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::get('/schools', function () {
    return view('frontend.schools');
})->name('schools');

Route::get('/ngos', function () {
    return view('frontend.ngos');
})->name('ngos');

Route::get('/resources', function () {
    $knowledgeHubs = \App\Models\KnowledgeHub::where('is_active', true)->get();
    return view('frontend.resources', compact('knowledgeHubs'));
})->name('resources');

Route::get('/article/{id}', function ($id) {
    $article = \App\Models\KnowledgeHub::where('id', $id)->where('type', 'article')->firstOrFail();
    return view('frontend.article', compact('article'));
})->name('article.show');

Route::get('/book', function () {
    return view('frontend.book');
})->name('book');

Route::get('/faq', function () {
    $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
    return view('frontend.faq', compact('faqs'));
})->name('faq');

Route::get('/approach', function () {
    return view('frontend.approach');
})->name('approach');

Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        session()->put('locale', $locale);
        cookie()->queue(cookie('app_locale', $locale, 525600));
    }
    return back();
})->name('set-locale');

// Backend CMS Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', \App\Livewire\Backend\Dashboard::class)->name('admin.dashboard');
    Route::get('/services', \App\Livewire\Backend\Services\ServicesManager::class)->name('admin.services');
    Route::get('/team', \App\Livewire\Backend\Team\TeamManager::class)->name('admin.team');
    Route::get('/achievements', \App\Livewire\Backend\Achievements\AchievementsManager::class)->name('admin.achievements');
    Route::get('/inquiries', \App\Livewire\Backend\Inquiries\InquiriesManager::class)->name('admin.inquiries');
    
    // New Managers
    Route::get('/sliders', \App\Livewire\Backend\Sliders\SlidersManager::class)->name('admin.sliders');
    Route::get('/faqs', \App\Livewire\Backend\Faq\FaqManager::class)->name('admin.faqs');
    Route::get('/knowledge-hub', \App\Livewire\Backend\KnowledgeHub\KnowledgeHubManager::class)->name('admin.knowledge_hub');
    Route::get('/users', \App\Livewire\Backend\Users\UsersManager::class)->name('admin.users');
    Route::get('/roles', \App\Livewire\Backend\Roles\RolesManager::class)->name('admin.roles');
    Route::get('/permissions', \App\Livewire\Backend\Permissions\PermissionsManager::class)->name('admin.permissions');
    Route::get('/translations', \App\Livewire\Backend\Translations\TranslationsManager::class)->name('admin.translations');
    Route::get('/profile', \App\Livewire\Backend\ProfileManager::class)->name('admin.profile');

    // System Settings & Monitoring
    Route::get('/settings/email', \App\Livewire\Backend\Settings\ManageEmailServicesPage::class)->name('admin.settings.email');
    Route::get('/monitoring/health', \App\Livewire\Backend\Monitoring\ManageSystemHealth::class)->name('admin.monitoring.health');
    Route::get('/monitoring/404-logs', \App\Livewire\Backend\Monitoring\ManageNotFoundLogs::class)->name('admin.monitoring.logs');
});
