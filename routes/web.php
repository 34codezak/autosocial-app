<?php

// use Illuminate\Support\Facades\Route;

// Load domain-specific route files
require __DIR__.'/marketing.php';
require __DIR__.'/auth.php';
require __DIR__.'/app.php';

// Global fallback
// Route::fallback(fn() => response()->view('errors.404', [], 404))->name('fallback');