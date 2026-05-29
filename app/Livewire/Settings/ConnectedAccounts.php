<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class ConnectedAccounts extends Component
{

    public array $accounts = [];

    public function mount() 
    {
        // 🔌 Replace with PlatformApiService::getConnectedAccounts(auth()->id())
        $this->accounts = [
            ['id' => 'acc_1', 'platform' => 'twitter', 'handle' => '@saas_builder', 'status' => 'active', 'connected_at' => '2024-02-14', 'token_expires' => '2024-08-14'],
            ['id' => 'acc_2', 'platform' => 'instagram', 'handle' => '@saas_visuals', 'status' => 'warning', 'connected_at' => '2024-01-10', 'token_expires' => '2024-04-10'],
            ['id' => 'acc_3', 'platform' => 'linkedin', 'handle' => 'Company Page', 'status' => 'expired', 'connected_at' => '2023-11-20', 'token_expires' => '2024-02-20'],
        ];
    }

    public function revoke(string $accountId) 
    {
        // Replace with OAuth logic
        $this->accounts = collect($this->accounts)->where('id', '!=', $accountId)->toArray();
        $this->dispatch('alert', type: 'info', message: 'Account  disconnected successfully');
    }

    public function reconnect(string $accountId) 
    {
        $this->dispatch('oauth-reconnect', accountId: $accountId);
    }

    public function render()
    {
        return view('livewire.settings.connected-accounts');
    }
}
