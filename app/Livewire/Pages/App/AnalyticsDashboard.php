<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;
use App\Services\DashboardMetricsService;

class AnalyticsDashboard extends Component
{
    public $dateRange = '30days';
    public $selectedPlatform = 'all';
    
    public function updatedDateRange()
    {
        $this->dispatch('analytics-updated');
    }
    
    public function render()
    {
        return view('livewire.pages.app.analytics-dashboard')
            ->layout('layouts.app', ['title' => 'Analytics']);
    }
}