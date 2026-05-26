<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] 
class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}
?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-xl border border-gray-200">
        
        <!-- PLATFORM LOGO -->
        <div class="flex justify-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/autos-logo.jpeg') }}" alt="Platform Logo" class="h-20 w-auto object-contain drop-shadow-sm">
            </a>
        </div>
    

        <!-- WELCOME HEADER -->
        <div class="text-center">
            <h2 class="mt-2 text-3xl font-extrabold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                Welcome Back
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Sign in to continue to your dashboard
            </p>
        </div>

        <!-- SESSION STATUS -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login" class="mt-8 space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input 
                        wire:model="form.email" 
                        id="email" 
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white" 
                        type="email" 
                        name="email" 
                        placeholder="name@example.com"
                        required 
                        autofocus 
                        autocomplete="username" 
                    />
                </div>
                @error('form.email')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input 
                        wire:model="form.password" 
                        id="password" 
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white" 
                        type="password" 
                        name="password" 
                        placeholder="••••••••"
                        required 
                        autocomplete="current-password" 
                    />
                </div>
                @error('form.password')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember" class="inline-flex items-center cursor-pointer">
                    <input 
                        wire:model="form.remember" 
                        id="remember" 
                        type="checkbox" 
                        class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500 focus:ring-2 transition-colors" 
                        name="remember"
                    >
                    <span class="ml-2 text-sm text-gray-600 select-none">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" wire:navigate class="text-sm font-medium text-orange-600 hover:text-orange-700 transition-colors">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- SIGN IN BUTTON (Centered) -->
            <div class="flex justify-center">
                <button type="submit" 
                    class="w-full max-w-xs py-3 px-4 rounded-xl font-semibold text-orange 
                    bg-gradient-to-r from-orange-500 via-orange-600 to-red-600 
                    hover:from-orange-600 hover:via-orange-700 hover:to-red-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 
                    shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 
                    transition-all duration-200 ease-in-out">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Sign In') }}
                    </span>
                </button>
            </div>

            <!-- REGISTER LINK (Centered) -->
            <div class="flex justify-center">
                <p class="text-sm text-gray-500">
                    Don't have an account?
                    <a href="{{ route('register') }}" wire:navigate 
                        class="font-semibold text-orange-600 hover:text-orange-700 underline decoration-orange-300 hover:decoration-orange-600 underline-offset-4 transition-all">
                        Create free account
                    </a>
                </p>
            </div>
        </form>

        <!-- FOOTER BADGE -->
        <div class="pt-4 border-t border-gray-200">
            <p class="text-center text-xs text-gray-400">
                Secured with <span class="text-orange-500 font-medium">256-bit encryption</span>
            </p>
        </div>
    </div>
</div>