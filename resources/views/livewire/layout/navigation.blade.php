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

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
             @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <!-- Guest Links -->
            @guest
                <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600">
                        {{ __('Log in') }}
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                        {{ __('Register') }}
                    </a>
                </div>
            @endguest

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
         @auth
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
        @endauth
    </div>
</nav>

<!--

<nav class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-accent-200 dark:border-slate-700"
     x-data="{ mobileMenuOpen: false }"
     role="navigation"
     aria-label="Main navigation">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group" aria-label="AutoSocial Home">
                <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="font-bold text-xl text-accent-800 dark:text-white group-hover:text-primary-600 transition-colors">
                    AutoSocial
                </span>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('product') }}" class="text-accent-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">Product</a>
                <a href="{{ route('features') }}" class="text-accent-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">Features</a>
                <a href="{{ route('pricing') }}" class="text-accent-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">Pricing</a>
                <a href="{{ route('demo') }}" class="text-accent-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">Demo</a>
                <a href="{{ route('blog') }}" class="text-accent-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">Blog</a>
            </div>

            {{-- Right Side Actions --}}
            <div class="hidden md:flex items-center space-x-4">
                {{-- Dark Mode Toggle --}}
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

            {{-- Mobile Menu Button --}}
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

    {{-- Mobile Menu --}}
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
            <a href="{{ route('blog') }}" @click="mobileMenuOpen = false" class="block py-2 text-accent-800 dark:text-accent-200 hover:text-primary-600 font-medium">Blog</a>
            
            <div class="pt-4 border-t border-accent-200 dark:border-slate-700 space-y-3">
                <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="block text-center py-2 text-accent-800 dark:text-accent-200 font-medium">Log in</a>
                <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="block text-center py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg font-medium">Start Free Trial</a>
            </div>
        </div>
    </div>
</nav>

-->
