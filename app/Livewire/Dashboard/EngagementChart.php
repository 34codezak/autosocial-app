<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class EngagementChart extends Component
{
    public string $period = '7d';
    public array $chartData = [];

    public function updatedPeriod()
    {
        $this->loadChartData();
        $this->dispatch('chart-updated', data: $this->chartData);
    }

    public function loadChartData()
    {
        // Mock structure. Replace with real query aggregation.
        $days = $this->period === '24h' ? range(0, 23, 4) : ($this->period === '7d' ? range(1, 7) : range(1, 30));
        $labels = collect($days)->map(fn($d) => $this->period === '24h' ? "{$d}:00" : "Day {$d}")->toArray();
        
        $this->chartData = [
            'labels' => $labels,
            'datasets' => [
                ['label' => 'Likes', 'data' => collect($days)->map(fn() => rand(50, 200))->toArray(), 'borderColor' => '#f97316', 'backgroundColor' => 'rgba(249, 115, 22, 0.1)', 'fill' => true],
                ['label' => 'Shares', 'data' => collect($days)->map(fn() => rand(10, 80))->toArray(), 'borderColor' => '#3b82f6', 'backgroundColor' => 'rgba(59, 130, 246, 0.1)', 'fill' => true],
            ]
        ];
    }

    public function mount() { $this->loadChartData(); }

    public function render()
    {
        return view('livewire.dashboard.engagement-chart');
    }
}