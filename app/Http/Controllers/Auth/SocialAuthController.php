<?php

/**
 * Core functions of this controller:- HTTP layer (routes & responses)
 *      1. Redirect to provider - handles the route that sends users to the social provider's login page
 *      2. Handle the callback - receives the response from the provider after the user authenticates, then delegates to the service handler
 *      3. Provide validation - ensures only allowed providers are accepted - rejecting invalid ones early
 *      4. Error handling - catches failures like denied permissions or expired tokens and redirects with a meaninful error
 *      5. Post-login redirection - after successful login, redirects the user to the intended page or a default route
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialOAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,  Log};


class SocialAuthController extends Controller
{
    public function __construct(protected SocialOAuthService $oauthService) {} 

    public function redirect(Request $request, string $platform) {
        $teamId = $request->user()->currentTeam?->id;

        if(!$teamId) {
            return redirect()->route('teams.select')
                ->with('error', 'Please select a team first');
        }

        return redirect()->away(
            $this->oauthService->getRedirectUrl($platform, $teamId)
        );
    }

    public function callback(Request $request, string $platform) {
        $user = Auth::user();
        $teamId = $request->get('state'); // passed via OAuth state param

        if (!$user || !$teamId || $user->currentTeam?->id !== (int) $teamId) {
            return redirect()->route('dashboard')
                ->with('error', 'Unauthorized connection attempt');
        }

        try {
            $account = $this->oauthService->handleCallback($platform, $teamId, $request->all());
            $displayName = data_get($account, 'display_name', data_get($account, 'name', 'Social account'));

            return redirect()->route('social-accounts.index')
                ->with('success', "{$displayName} connected successfully!");
        }catch(\Exception $e) {
            Log::error("Social OAuth callback failed: {$e->getMessage()}");
            return redirect()->route('social-accounts.index')
                ->with('error', "Failed to connect {$platform}: " . $e->getMessage());
        }
    }
}

// This controller is the entry and exit pt for social login - it receives the HTTP requests, 
// delegates the heavy lifting to the service handler, and returns the appropriate response to the user
// create its routes/web.php (inside auth middleware group)

