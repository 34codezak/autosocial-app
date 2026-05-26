<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-accent-200 dark:border-slate-700"
     x-data="{ mobileMenuOpen: false }"
     role="navigation"
     aria-label="Main navigation">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Platform Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group" aria-label="AutoSocial Home">
                <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center">
                    <img src="{{ asset('images/autos-logo.jpeg') }}" alt="Platform Logo" class="h-20 w-auto object-contain drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </img>
                </div>
                <span class="font-bold text-xl text-accent-800 dark:text-white group-hover:text-primary-600 transition-colors">
                    AutoSocial
                </span>
            </a>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('product') }}" class="text-accent-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">Product</a>
                <a href="{{ route('features') }}" class="text-accent-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">Features</a>
                <a href="{{ route('pricing') }}" class="text-accent-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">Pricing</a>
                <a href="{{ route('demo') }}" class="text-accent-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">Demo</a>
            </div>

            <!-- Right Side Actions -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode"
                        class="p-2 rounded-lg hover:bg-accent-200 dark:hover:bg-slate-700 transition-colors"
                        aria-label="Toggle dark mode"
                        :aria-pressed="darkMode">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>

                <a href="{{ route('login') }}" class="text-accent-800 dark:text-accent-200 hover:text-primary-600 font-medium">Log in</a>
                <a href="{{ route('register') }}" 
                   class="px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg font-medium hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25">
                    Start Free Trial
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden p-2 rounded-lg hover:bg-accent-200 dark:hover:bg-slate-700"
                    aria-label="Toggle mobile menu"
                    :aria-expanded="mobileMenuOpen"
                    aria-controls="mobile-menu">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         id="mobile-menu"
         class="md:hidden border-t border-accent-200 dark:border-slate-700 bg-white dark:bg-slate-900">
        
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('product') }}" @click="mobileMenuOpen = false" class="block py-2 text-accent-800 dark:text-accent-200 hover:text-primary-600 font-medium">Product</a>
            <a href="{{ route('features') }}" @click="mobileMenuOpen = false" class="block py-2 text-accent-800 dark:text-accent-200 hover:text-primary-600 font-medium">Features</a>
            <a href="{{ route('pricing') }}" @click="mobileMenuOpen = false" class="block py-2 text-accent-800 dark:text-accent-200 hover:text-primary-600 font-medium">Pricing</a>
            <a href="{{ route('demo') }}" @click="mobileMenuOpen = false" class="block py-2 text-accent-800 dark:text-accent-200 hover:text-primary-600 font-medium">Demo</a>
            
            <div class="pt-4 border-t border-accent-200 dark:border-slate-700 space-y-3">
                <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="block text-center py-2 text-accent-800 dark:text-accent-200 font-medium">Log in</a>
                <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="block text-center py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg font-medium">Start Free Trial</a>
            </div>
        </div>
    </div>
</nav>
