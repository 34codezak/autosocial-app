<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\{
    RegisteredUserController,
    AuthenticatedSessionController,
    SocialAuthController
};

Route::middleware(['web', 'guest'])->group(function () {

    // Registration
    Volt::route('/register', 'actions.auth.register')->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    // Login
    Volt::route('/login', 'actions.auth.login')->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    // Social Auth
    Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
        ->name('social.redirect');
    Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
        ->name('social.callback');

    // Password reset flows (Breeze defaults)
    // Route::controller(PasswordResetLinkController::class)->group(function () {
    //     Route::get('/forgot-password', 'create')->name('password.request');
    //     Route::post('/forgot-password', 'store')->name('password.email');
    // });
});

// Logout (requires auth)
Route::middleware(['web', 'auth'])->post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


/*

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\LoginController;

Route::middleware(['web', 'guest'])->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
 */