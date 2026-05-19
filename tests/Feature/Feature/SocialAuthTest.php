<?php

namespace Tests\Feature\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SocialAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_connect_facebook_account(): void
{
    $user = User::factory()->create();
    $team = Team::factory()->create();
    $user->teams()->attach($team, ['role' => 'owner']);
    
    // Mock Socialite response
    $abstractUser = Mockery::mock(\Laravel\Socialite\Two\User::class);
    $abstractUser->allows([
        'id' => '12345',
        'name' => 'Test Page',
        'avatar' => 'https://example.com/avatar.jpg',
        'token' => 'mock_access_token',
        'refreshToken' => 'mock_refresh_token',
        'expiresIn' => 3600,
        'scopes' => ['pages_manage_posts', 'pages_read_engagement']
    ]);
    
    Socialite::shouldReceive('driver->user')->andReturn($abstractUser);
    
    $response = $this->actingAs($user)
        ->get('/auth/facebook/callback?state=' . $team->id);
    
    $response->assertRedirect(route('social-accounts.index'));
    $this->assertDatabaseHas('social_accounts', [
        'platform' => 'facebook',
        'display_name' => 'Test Page',
        'is_active' => true
    ]);
}
}
