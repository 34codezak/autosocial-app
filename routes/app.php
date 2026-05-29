<?php

// Authenticated SaaS Application

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\App\{
    Dashboard,
    Workspace,
    AnalyticsDashboard
};

use App\Livewire\Features\{
    PostEditor,
    PostCalendar
    // AnalyticsDashboard,
    // Workspace,
    // Services
};

Route::middleware(['web', 'auth', 'verified'])->prefix('app')->name('app.')->group(function () {

    // Main Dashboard (redirects to default section)
    Route::get('/dashboard', \App\Livewire\Pages\App\Dashboard::class)->name('dashboard');

    // Dashboard Sections (feature modules)
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/editor', PostEditor::class)->name('editor');
        Route::get('/calendar', PostCalendar::class)->name('calendar');
        Route::get('/analytics', AnalyticsDashboard::class)->name('analytics');
    });

    // User Profile & Settings
    Route::view('/profile', 'app.profile')->name('profile');

    // Workspace & Services
    Route::get('/workspace', Workspace::class)->name('workspace');
    Route::view('/services', 'app.services')->name('services');

    // Account Management
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::view('/account', 'app.settings.account')->name('account');
        Route::view('/billing', 'app.settings.billing')->name('billing');
        Route::view('/security', 'app.settings.security')->name('security');
    });

    // API Token Management (if using Laravel Sanctum)
    // Route::get('/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
});

// Post-login redirect (override Breeze default)
Route::get('/redirect-after-login', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('redirect.after.login');