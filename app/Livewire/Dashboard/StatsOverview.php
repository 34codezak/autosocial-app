<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;

class StatsOverview extends Component
{
    public array $metrics = [];
    public bool $loading = true;

    public function mount()
    {
        $this->refreshMetrics();
    }

    // Triggered by layout polling or manual refresh
    #[On('dashboard-refresh')]
    public function refreshMetrics()
    {
        $this->loading = true;
        
        // 🔌 Replace with: $this->metrics = app(\App\Support\Services\AnalyticsAggregator::class)->getSummary();
        $this->metrics = [
            ['label' => 'Total Followers', 'value' => '24.5K', 'trend' => '+12%', 'trendUp' => true, 'icon' => '👥'],
            ['label' => 'Engagement Rate', 'value' => '4.8%', 'trend' => '+0.5%', 'trendUp' => true, 'icon' => '❤️'],
            ['label' => 'Posts Published', 'value' => '142', 'trend' => '-2%', 'trendUp' => false, 'icon' => '📝'],
            ['label' => 'API Usage', 'value' => '1.2M', 'trend' => '+8%', 'trendUp' => true, 'icon' => '🔌'],
        ];

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.dashboard.stats-overview');
    }
}