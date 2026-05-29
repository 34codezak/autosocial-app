<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia; // Optional: remove if not using Inertia
use Laravel\Socialite\Facades\Socialite; // Optional: for social auth hints

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request (POST /login).
     *
     * This is called by your Volt Login component after validation.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt authentication
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Regenerate session to prevent fixation attacks
        $request->session()->regenerate();

        // Redirect to intended URL or default dashboard
        $redirect = redirect()->intended(route('app.dashboard', absolute: false));

        // Optional: Add flash message for UX
        $redirect->with('status', __('auth.logged_in'));

        return $redirect;
    }

    /**
     * Destroy an authenticated session (POST /logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Clear any two-factor auth session flags
        if ($request->session()->has('auth.two_factor_confirmed_at')) {
            $request->session()->forget('auth.two_factor_confirmed_at');
        }

        Auth::guard('web')->logout();

        // Invalidate session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to home with status
        return redirect()->route('home')->with('status', __('auth.logged_out'));
    }

    /**
     * Handle social auth callback (optional helper).
     * 
     * If you're using SocialAuthController separately, you can remove this.
     */
    public function socialCallback(Request $request, string $provider): RedirectResponse
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Find or create user
            $user = \App\Models\User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName(),
                    'password' => bcrypt(str()->random(24)),
                    'email_verified_at' => now(),
                ]
            );
            
            // Link social account if not already linked
            $user->socialAccounts()->firstOrCreate(
                ['provider' => $provider, 'provider_id' => $socialUser->getId()],
                [
                    'name' => $socialUser->getName(),
                    'avatar' => $socialUser->getAvatar(),
                    'token' => encrypt($socialUser->token),
                    'refresh_token' => encrypt($socialUser->refreshToken ?? ''),
                ]
            );
            
            // Login and redirect
            Auth::login($user, true);
            $request->session()->regenerate();
            
            return redirect()->intended(route('app.dashboard'))->with('status', "Connected to {$provider}!");
            
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', __('auth.social_failed', ['provider' => ucfirst($provider)]));
        }
    }
}