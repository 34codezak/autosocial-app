<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;
use App\Services\DashboardMetricsService;

class Dashboard extends Component
{
    public $metrics;
    
    public function mount(DashboardMetricsService $service)
    {
        $this->metrics = $service->getSummary(auth()->user());
    }
    
    public function render()
    {
        return view('livewire.pages.app.dashboard')
            ->layout('layouts.app', ['title' => 'Dashboard']);
    }
}