<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;
use App\Models\SocialAccount;

class Workspace extends Component
{
    public $accounts;
    
    public function mount()
    {
        $this->accounts = auth()->user()->socialAccounts()
            ->with('platform')
            ->get();
    }
    
    public function disconnect($accountId)
    {
        $account = auth()->user()->socialAccounts()->findOrFail($accountId);
        $account->delete();
        
        $this->accounts = $this->accounts->reject(fn($a) => $a->id === $accountId);
        $this->dispatch('notify', message: 'Account disconnected');
    }
    
    public function render()
    {
        return view('livewire.pages.app.workspace')
            ->layout('layouts.app', ['title' => 'Workspace']);
    }
}