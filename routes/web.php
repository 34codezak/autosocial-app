<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route for AutoSocial's Social Auth
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/auth/{platform}/connect', [SocialAuthController::class, 'redirect'])
        ->name('social.connect');

    Route::get('/auth/{platform}/callback', [SocialAuthController::class, 'callback'])
        ->name('social.callback');
});

require __DIR__.'/auth.php';
