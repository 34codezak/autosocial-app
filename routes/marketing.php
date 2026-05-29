<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['web'])->group(function () {
    
    Route::view('/', 'marketing.home')->name('home');

    Route::prefix('marketing')->name('marketing.')->group(function () {
        Route::view('/product', 'marketing.product')->name('product');
        Route::view('/features', 'marketing.features')->name('features');
        Route::view('/pricing', 'marketing.pricing')->name('pricing');
        Route::view('/demo', 'marketing.demo')->name('demo');
        Route::view('/about', 'marketing.about')->name('about');
        Route::view('/faq', 'marketing.faq')->name('faq');
    });

    Volt::route('/contact', 'actions.marketing.contact')
        ->middleware(['throttle:30,1'])
        ->name('contact');
});