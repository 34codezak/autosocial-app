<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;

class RecentActivity extends Component
{
    public $activities = [];

    #[On('dashboard-refresh')]
    public function loadActivities()
    {
        // 🔌 Replace with Activity/Event log query
        $this->activities = collect([
            ['type' => 'post_published', 'platform' => 'Twitter', 'time' => '2m ago', 'details' => 'Published "Weekly analytics update"'],
            ['type' => 'connection_added', 'platform' => 'Instagram', 'time' => '1h ago', 'details' => 'Connected @brand_official account'],
            ['type' => 'schedule_failed', 'platform' => 'LinkedIn', 'time' => '3h ago', 'details' => 'Auto-retry scheduled in 15m'],
            ['type' => 'milestone', 'platform' => 'All', 'time' => '1d ago', 'details' => 'Reached 25K total followers'],
        ]);
    }

    public function mount() { $this->loadActivities(); }

    public function render()
    {
        return view('livewire.dashboard.recent-activity');
    }
}
