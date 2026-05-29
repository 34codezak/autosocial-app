<?php

namespace App\Livewire\Platforms;

use Livewire\Component;

class AccountSelector extends Component
{
    public array $availableAccounts = [
        ['platform' => 'twitter', 'handle' => '@handle_main', 'avatar' => null],
        ['platform' => 'twitter', 'handle' => '@brand_official', 'avatar' => null],
        ['platform' => 'instagram', 'handle' => '@visual_studio', 'avatar' => null],
    ];
    public array $selected = [];

    public function toggleAccount(string $key)
    {
        $this->selected = in_array($key, $this->selected)
            ? array_diff($this->selected, [$key])
            : [...$this->selected, $key];
        
        $this->dispatch('accounts-updated', selected: $this->selected);
    }

    public function selectAll()
    {
        $this->selected = collect($this->availableAccounts)->map(fn($a) => "{$a['platform']}:{$a['handle']}")->toArray();
        $this->dispatch('accounts-updated', selected: $this->selected);
    }

    public function render()
    {
        return view('livewire.platforms.account-selector');
    }
}
