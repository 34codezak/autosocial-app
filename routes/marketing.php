<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Demo; // 1. Import your new Livewire component at the top

Route::middleware(['web'])->group(function () {
    
    Route::view('/', 'home')->name('home');

    // 2. Define the Demo route OUTSIDE the 'marketing.' name prefix 
    // so that route('demo') works exactly as your views expect.
    Route::get('/demo', Demo::class)->name('demo');

    Route::prefix('marketing')->name('marketing.')->group(function () {
        Route::view('/product', 'marketing.product')->name('product');
        Route::view('/features', 'marketing.features')->name('features');
        Route::view('/pricing', 'marketing.pricing')->name('pricing');
        
        // 3. DELETE the old Route::view('/demo', 'marketing.demo') line from here
        
        Route::view('/about', 'marketing.about')->name('about');
        Route::view('/faq', 'marketing.faq')->name('faq');
    });

    Volt::route('/contact', 'actions.marketing.contact')
        ->middleware(['throttle:30,1'])
        ->name('contact');
});