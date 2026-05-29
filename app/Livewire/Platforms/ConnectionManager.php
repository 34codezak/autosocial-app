<?php

namespace App\Livewire\Platforms;

use Livewire\Component;

class ConnectionManager extends Component
{
    public array $platforms = [];

    public function mount()
    {
        $this->platforms = [
            ['id' => 'twitter', 'name' => 'X / Twitter', 'connected' => true, 'status' => 'active', 'accounts' => ['@handle_main', '@brand_official']],
            ['id' => 'instagram', 'name' => 'Instagram', 'connected' => true, 'status' => 'token_expiring_soon', 'accounts' => ['@visual_studio']],
            ['id' => 'linkedin', 'name' => 'LinkedIn', 'connected' => false, 'status' => 'disconnected', 'accounts' => []],
            ['id' => 'facebook', 'name' => 'Facebook Pages', 'connected' => false, 'status' => 'disconnected', 'accounts' => []],
        ];
    }

    public function initiateOAuth(string $platformId)
    {
        // Replace with: redirect()->away(config("services.{$platformId}.oauth_url"));
        $this->dispatch('oauth-initiated', platform: $platformId);
    }

    public function disconnect(string $platformId)
    {
        // Replace with: PlatformApiService::revoke($platformId);
        $collect = collect($this->platforms)->firstWhere('id', $platformId);
        $collect['connected'] = false;
        $collect['status'] = 'disconnected';
        $collect['accounts'] = [];
        $this->dispatch('platform-disconnected', platform: $platformId);
    }

    public function render()
    {
        return view('livewire.platforms.connection-manager');
    }
}
