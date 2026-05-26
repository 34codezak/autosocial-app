<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class Dashboard extends Component
{
    public array $metrics = [];
    public array $recentPosts = [];
    public array $platformBreakdown = [];
    public string $lastUpdated;
    public bool $isLive = true;
    public array $trendData = [];

    public function mount(DashboardMetricsService $metricsService): void
    {
        $user = auth()->user();
        $data = $service->getMetrics($user);

        $this->refreshData();
        $this->lastUpdated = now()->format('M d, Y \a\t h:i A');

        $this->userName = $user->name;
        $this->metrics = $metricsService->getMetrics($user);
         $this->recentPosts = $data['recentPosts'];
         $this->platformBreakdown = $data['platformBreakdown'];
    }

    public function refreshData()
    {
        // Simulate real-time DB/Supabase fetch
        $this->metrics = [
            'views'    => ['value' => rand(14200, 16800), 'trend' => rand(-2, 24), 'icon' => 'eye'],
            'likes'    => ['value' => rand(3400, 4200),   'trend' => rand(-5, 18), 'icon' => 'heart'],
            'comments' => ['value' => rand(480, 920),     'trend' => rand(-8, 22), 'icon' => 'chat'],
            'shares'   => ['value' => rand(820, 1150),    'trend' => rand(-3, 15), 'icon' => 'share']
        ];

        $this->recentPosts = collect([
            ['title' => 'Summer Product Launch', 'platform' => 'Instagram', 'status' => 'published', 'engagement' => rand(120, 540), 'time' => '2h ago', 'type' => 'image'],
            ['title' => 'Behind the Scenes',     'platform' => 'TikTok',    'status' => 'publishing', 'engagement' => rand(10, 80),  'time' => '12m ago', 'type' => 'video'],
            ['title' => 'Weekly Tips Thread',    'platform' => 'X/Twitter', 'status' => 'scheduled',  'engagement' => 0,            'time' => 'in 3h', 'type' => 'text'],
            ['title' => 'Client Success Story',  'platform' => 'LinkedIn',  'status' => 'failed',     'engagement' => 0,            'time' => '1h ago', 'type' => 'document'],
        ]);

        $this->platformBreakdown = [
            ['name' => 'Instagram', 'engagement' => rand(4200, 5800), 'color' => 'from-pink-500 to-orange-400'],
            ['name' => 'TikTok',    'engagement' => rand(5500, 8200), 'color' => 'from-gray-800 to-cyan-400'],
            ['name' => 'LinkedIn',  'engagement' => rand(1400, 2600), 'color' => 'from-blue-600 to-blue-400'],
            ['name' => 'X',         'engagement' => rand(2100, 3400), 'color' => 'from-gray-900 to-gray-600'],
        ];

        // Generate 24h trend sparkline data
        $this->trendData = collect(range(0, 23))->map(fn($h) => rand(100, 400))->toArray();
        $this->lastUpdated = now()->format('H:i:s');
    }

    // Listen for real-time Supabase events
    #[On('supabase-realtime-update')]
    public function handleRealtimeUpdate($table, $event, $payload)
    {
        if ($table === 'analytics_snapshots' && $event === 'UPDATE') {
            $this->refreshData();
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}