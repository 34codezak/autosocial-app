<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Marketing\ContactPage;

Route::view('/', 'home')->name('home');

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


// Public marketing pages
Route::view('/product', 'pages.product')->name('product');
Route::view('/features', 'pages.features')->name('features');
Route::view('/pricing', 'pages.pricing')->name('pricing');
Route::view('/demo', 'pages.demo')->name('demo');
Route::view('/integrations', 'pages.integrations')->name('integrations');
Route::view('/accessibility', 'pages.accessibility')->name('accessibility');
Route::view('/about', 'pages.about')->name('about');
Route::view('/blog', 'pages.blog')->name('blog');
Route::view('/faq', 'pages.faq')->name('faq');

// Interactive pages with Livewire
Route::get('/contact', ContactPage::class)
    ->middleware(['throttle:30,1']) // Rate limit contact form
    ->name('contact');


// Auth route (Breeze)
require __DIR__.'/auth.php';
