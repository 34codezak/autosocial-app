<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RefreshSocialAccountTokens implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $expiringSoon = SocialAccount::whereNotNull('token_expires_at')
            ->where('token_exprites_at', '<=', now()->addHour())
            ->where('is_active', true)
            ->get();

        foreach($expiringSoon as $account) {
            try{
                $success = app(SocialOAuthService::class)->refreshAccessToken($account);
                if(!success) {
                    $account->update(['is_active' => false]);
                    // Notify team admins
                    $account->team->users()->wherePivot('role', 'owner')
                        ->get()->each(fn($user) => 
                            $user->notify(new SocialAccountDisconnected($account))
                );
            }
            } catch(\Expression $e) {
                \Log::error("Token refresh failed for account {$account->id}: {$e->getMessage}");
            }
        }
    }
}
