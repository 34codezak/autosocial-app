<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class AudienceGrowth extends Component
{
    public string $range = '30d';
    public array $data = [];

    public function setRange($range)
    {
        $this->range = $range;
        $this->fetchData();
    }

    public function fetchData()
    {
        // 🔌 Replace with Analytics Service call
        $this->data = [
            'current' => 24500,
            'previous' => 23100,
            'netGrowth' => 1400,
            'dailyAverage' => 46.7,
            'topSource' => 'Twitter/X',
        ];
    }

    public function mount() { $this->fetchData(); }

    public function render()
    {
        return view('livewire.dashboard.audience-growth');
    }
}
