<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] 
class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 py-12 px-4 sm:px-6 lg:px-8" x-data="{ showPassword: false, showPasswordConfirm: false }">
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
                Create Account
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Join us and start your journey today
            </p>
        </div>

        <form wire:submit="register" class="mt-8 space-y-6">
            @csrf

            <!-- Full Name -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Full Name
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input 
                        wire:model="name" 
                        id="name" 
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white" 
                        type="text" 
                        name="name" 
                        placeholder="Your Name"
                        required 
                        autofocus 
                        autocomplete="name" 
                    />
                </div>
                @error('name')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

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
                        wire:model="email" 
                        id="email" 
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white" 
                        type="email" 
                        name="email" 
                        placeholder="name@example.com"
                        required 
                        autocomplete="username" 
                    />
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password with Visibility Toggle -->
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
                        wire:model="password" 
                        id="password" 
                        class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white" 
                        :type="showPassword ? 'text' : 'password'"
                        name="password" 
                        placeholder="••••••••"
                        required 
                        autocomplete="new-password" 
                    />
                    <!-- Toggle Button -->
                    <button 
                        type="button"
                        @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-orange-600 transition-colors focus:outline-none"
                        tabindex="-1"
                    >
                        <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Confirm Password with Visibility Toggle -->
            <div class="space-y-2">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Confirm Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <input 
                        wire:model="password_confirmation" 
                        id="password_confirmation" 
                        class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white" 
                        :type="showPasswordConfirm ? 'text' : 'password'"
                        name="password_confirmation" 
                        placeholder="••••••••"
                        required 
                        autocomplete="new-password" 
                    />
                    <!-- Toggle Button -->
                    <button 
                        type="button"
                        @click="showPasswordConfirm = !showPasswordConfirm"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-orange-600 transition-colors focus:outline-none"
                        tabindex="-1"
                    >
                        <svg x-show="!showPasswordConfirm" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showPasswordConfirm" class="h-5 w-5" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- PASSWORD REQUIREMENTS HINT -->
            <div class="text-xs text-gray-500 bg-gray-50 p-3 rounded-lg border border-gray-200">
                <p class="font-medium text-gray-700 mb-1">Password must contain:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    <li>At least 8 characters</li>
                    <li>One uppercase and lowercase letter</li>
                    <li>One number</li>
                </ul>
            </div>

            <!-- REGISTER BUTTON (Centered) -->
            <div class="flex justify-center pt-2">
                <button type="submit" 
                    class="w-full max-w-xs py-3 px-4 rounded-xl font-semibold text-orange 
                    bg-gradient-to-r from-orange-500 via-orange-600 to-red-600 
                    hover:from-orange-600 hover:via-orange-700 hover:to-red-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 
                    shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 
                    transition-all duration-200 ease-in-out">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        {{ __('Get Started') }}
                    </span>
                </button>
            </div>

            <!-- LOGIN LINK (Centered) -->
            <div class="flex justify-center">
                <p class="text-sm text-gray-500">
                    Already have an account?
                    <a href="{{ route('login') }}" wire:navigate 
                        class="font-semibold text-orange-600 hover:text-orange-700 underline decoration-orange-300 hover:decoration-orange-600 underline-offset-4 transition-all">
                        Sign in here
                    </a>
                </p>
            </div>
        </form>

        <!-- FOOTER BADGE -->
        <div class="pt-4 border-t border-gray-200">
            <p class="text-center text-xs text-gray-400">
                By registering, you agree to our <a href="#" class="text-orange-600 hover:underline">Terms</a> and <a href="#" class="text-orange-600 hover:underline">Privacy Policy</a>
            </p>
        </div>
    </div>
</div>