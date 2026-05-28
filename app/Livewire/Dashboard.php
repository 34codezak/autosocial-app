<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\DashboardMetricsService;

class Dashboard extends Component
{
    public array $metrics = [];
    public array $recentPosts = [];
    public array $platformBreakdown = [];
    public array $trendData = [];

    public string $lastUpdated = '';
    public string $userName = '';
    public string $trendPeriod = '24h';

    public bool $isLive = true;

    public function mount(DashboardMetricsService $metricsService): void
    {
        $user = auth()->user();

        if (!$user) {
            $this->redirect('/login');
            return;
        }

        $this->refreshData();

        $data = $metricsService->getMetrics($user);

        $this->userName = $user->name;

        $this->recentPosts = $data['recentPosts'] ?? [];
        $this->platformBreakdown = $data['platformBreakdown'] ?? [];

        $this->lastUpdated = now()->format('M d, Y \\a\\t h:i A');
    }

    public function refreshData(): void
    {
        $this->metrics = [
            'views' => [
                'value' => rand(14200, 16800),
                'trend' => rand(-2, 24),
                'trendUp' => rand(-2, 24) >= 0,
                'icon' => 'eye'
            ],

            'likes' => [
                'value' => rand(3400, 4200),
                'trend' => rand(-5, 18),
                'trendUp' => rand(-5, 18) >= 0,
                'icon' => 'heart'
            ],

            'comments' => [
                'value' => rand(480, 920),
                'trend' => rand(-8, 22),
                'trendUp' => rand(-8, 22) >= 0,
                'icon' => 'chat'
            ],

            'shares' => [
                'value' => rand(820, 1150),
                'trend' => rand(-3, 15),
                'trendUp' => rand(-3, 15) >= 0,
                'icon' => 'share'
            ]
        ];

        $this->platformBreakdown = [
            [
                'name' => 'Instagram',
                'engagement' => rand(4200, 5800),
                'color' => 'from-pink-500 to-orange-400'
            ],

            [
                'name' => 'TikTok',
                'engagement' => rand(5500, 8200),
                'color' => 'from-gray-800 to-cyan-400'
            ],

            [
                'name' => 'LinkedIn',
                'engagement' => rand(1400, 2600),
                'color' => 'from-blue-600 to-blue-400'
            ],

            [
                'name' => 'X',
                'engagement' => rand(2100, 3400),
                'color' => 'from-gray-900 to-gray-600'
            ]
        ];

        $count = match ($this->trendPeriod) {
            '7d' => 7,
            '30d' => 30,
            default => 24,
        };

        $this->trendData = collect(range(1, $count))
            ->map(fn () => rand(100, 400))
            ->toArray();

        $this->lastUpdated = now()->format('H:i:s');
    }

    #[On('supabase-realtime-update')]
    public function handleRealtimeUpdate($table, $event, $payload): void
    {
        if ($table === 'analytics_snapshots' && $event === 'UPDATE') {
            $this->refreshData();
        }
    }

    public function updatedTrendPeriod(): void
    {
        $this->refreshData();
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('components.layouts.app');
    }
}