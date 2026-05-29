<?php

namespace App\Livewire\Pages\App\AutoSocial;

use Livewire\Component;
use App\Services\SocialOAuthService;

class Dashboard extends Component
{
    public $activeTab = 'accounts';
    public $connectedAccounts;
    public $autoPostRules;
    
    public function mount(SocialOAuthService $oauth)
    {
        $this->connectedAccounts = auth()->user()->socialAccounts()
            ->with('platform')
            ->get();
        $this->autoPostRules = auth()->user()->autoPostRules ?? collect();
    }
    
    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function render()
    {
        return view('livewire.pages.app.autosocial.dashboard')
            ->layout('layouts.app', ['title' => 'AutoSocial']);
    }
}