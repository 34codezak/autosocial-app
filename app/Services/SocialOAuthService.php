<?php

// Business logic layer
// DB lookups, token storage
// Knows about User model, Socialite data
// Calls Socialite, Eloquent
// This handler manages the authentication flow when user sign in via third-party 
// providers (Google, GitHub, Facebook), using the Laravel Socialite package
/** 
 * Redirects the user to the provider
 * Handles the callback after the provider auths the user, redirecting back to the app with an authorization code
 * Finds or creates a user 
 * Manages tokens and token refreshes ==> stores the prividers access_token and optionally refresh_token for making API calls on behalf of the user later
 * Session/Auth handling ==> calls Auth::login($user) to establish a Laravel session after successful OAuth resolution
 * */

namespace App\Services;

use Laravel\Socialite\Facades\Socialite;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Crypt;

class SocialOAuthService {
    protected $platformConfigs = [
        'facebook' => ['scopes' => ['pages_manage_posts', 'pages_read_engagement', 'instgram_basid']],
        'instagram' => ['scopes' => ['instagram_basic', 'instagram_content_publish']],
        'twitter' => ['scopes' => ['tweet.read', 'tweet.write', 'users.read']],
        'linkedin' => ['scopes' => ['w_member_social', 'r_liteprofile']],
        'tiktok' => ['scopes' => ['video.publish', 'user.info.basic']],
    ];

    public function getRedirectUrl(string $platform, string $teamID): string {
        return Socialite::driver($platform)
                ->with(['state' => $teamID]) // pass team_id via state
                ->scopes($this->platformConfigs[$platform]['scopes'])
                ->redirect()
                ->getTargetUrl();
    }

    public function handleCallback(string $platform, string $teamId, $callbackData): SocialAccount {
        $socialUser = Socialite::driver($platform)->user();

        // Encrypt tokens before storing
        $accessToken = Crypt::encryptString($socialUser->token);
        $refreshToken = $socialUser->refreshToken ? Crypt::encryptString($socialUser->refreshToken) : null;

        // Extract platform-specific account info
        $accountData = $this->extractAccountData($platform, $socialUser);

        return SocialAccount::updateOrCreate(
            [
                'team_id' => $teamID,
                'platform' => $platform,
                'platform_account_id' => $accountData['platform_id'],
            ],
            [
                'display_name' => $accountData['display_name'],
                'avatar_url' => $accountData['avatar_url'],
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'token_expires_at' => $socialUser->expiresIn ? now()->addSeconds($socialUser->expiresIn) : null,
                'permissions' => $this->mapPermissions($platform, $socialUser->scopes ?? []),
                'is_active' => true,
                'last_used_at' => now(),
            ]
            
        );
}
        protected function extractAccountData(string $platform, $socialUser): array {
        return match($platform) {
            'facebook' => [
                'platform_id' => $socialUser->id,
                'display_name' => $socialUser->name,
                'avatar_url' => $socialUser->avatar,
            ],
            'instagram' => [
                'platform_id' => $socialUser->id,
                'display_name' => $socialUser->name,
                'avatar_url' => $socialUser->avatar,
            ],
            'twitter' => [
                'platform_id' => $socialUser->id,
                'display_name' => $socialUser->name,
                'avatar_url' => $socialUser->avatar,
            ],
            // ... add others
            default => throw new \InvalidArgumentException("Unsupported platform: {$platform}")
        };
    }

    protected function mapPermissions(string $platform, array $scopes): array
    {
        // Map OAuth scopes to our internal permission strings
        $permissions = [];
        if (str_contains(implode(',', $scopes), 'publish')) {
            $permissions[] = 'publish_posts';
        }
        if (str_contains(implode(',', $scopes), 'read') || str_contains(implode(',', $scopes), 'insights')) {
            $permissions[] = 'read_insights';
        }
        if (str_contains(implode(',', $scopes), 'manage_comments')) {
            $permissions[] = 'manage_comments';
        }
        return $permissions;
    }

    public function refreshAccessToken(SocialAccount $account): bool
    {
        // Platform-specific token refresh logic
        // Return true if successful, false if re-authentication needed
        // Implement per-platform using refresh_token
        return true; // placeholder
    }

    public function getDecryptedAccessToken(SocialAccount $account): string
    {
        return Crypt::decryptString($account->access_token);
    }
}
