<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class PlatformHealth extends Component
{
    public array $connections = [];
    public array $apiQuotas = [];

    public function mount() { $this->checkStatus(); }

    public function checkStatus()
    {
        // 🔌 Replace with PlatformApiService
        $this->connections = [
            ['platform' => 'Twitter', 'status' => 'connected', 'lastSync' => '2m ago'],
            ['platform' => 'Instagram', 'status' => 'connected', 'lastSync' => '5m ago'],
            ['platform' => 'LinkedIn', 'status' => 'warning', 'lastSync' => '1h ago'],
        ];
        $this->apiQuotas = [
            ['platform' => 'Twitter API', 'used' => 75, 'limit' => 100],
            ['platform' => 'Meta Graph', 'used' => 42, 'limit' => 100],
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.platform-health');
    }
}
