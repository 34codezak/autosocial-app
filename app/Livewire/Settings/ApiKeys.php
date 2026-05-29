<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Str;

class ApiKeys extends Component
{
    public string $keyName = '';
    public array $keys = [];
    public string $newKey = '';
    public bool $showCreate = false;

    public function mount()
    {
        $this->keys = [
            ['id' => 'k1', 'name' => 'Production App', 'key' => 'sk_live_' . Str::random(32), 'created_at' => '2024-03-15', 'expires_at' => '2025-03-15', 'last_used' => '2 hours ago'],
            ['id' => 'k2', 'name' => 'Staging Environment', 'key' => 'sk_test_' . Str::random(32), 'created_at' => '2024-01-10', 'expires_at' => null, 'last_used' => '3 days ago'],
        ];
    }

    public function createKey()
    {
        $this->validate(['keyName' => 'required|string|max:50']);
        $this->newKey = 'sk_live_' . Str::random(40);
        $this->keys[] = [
            'id' => 'k_' . time(),
            'name' => $this->keyName,
            'key' => $this->newKey,
            'created_at' => now()->format('Y-m-d'),
            'expires_at' => now()->addYear()->format('Y-m-d'),
            'last_used' => 'Never'
        ];
        $this->keyName = '';
        $this->showCreate = false;
        $this->dispatch('alert', type: 'success', message: 'API key created. Copy it now, you won\'t see it again.');
    }

    public function revoke(string $keyId)
    {
        $this->keys = array_values(array_filter($this->keys, fn($k) => $k['id'] !== $keyId));
        $this->dispatch('alert', type: 'warning', message: 'API key revoked immediately.');
    }

    public function render()
    {
        return view('livewire.settings.api-keys');
    }
}
