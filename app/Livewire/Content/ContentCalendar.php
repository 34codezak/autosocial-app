<?php

namespace App\Livewire\Content;

use Livewire\Component;
use Carbon\Carbon;

class ContentCalendar extends Component
{
    public array $events = [];
    public bool $showComposer = false;

    public function mount()
    {
        // Trigger initial load via JS datesSet callback
    }

    // Called by FullCalendar when view changes or navigates
    public function fetchEvents(string $start, string $end)
    {
        $this->loadEvents(Carbon::parse($start), Carbon::parse($end));
        $this->dispatch('events-loaded', events: $this->events);
    }

    protected function loadEvents(Carbon $start, Carbon $end)
    {
        // 🔌 Replace with: $posts = auth()->user()->posts()->scheduledBetween($start, $end)->get();
        $this->events = collect(range(1, 12))->map(fn($day) => [
            'id' => "evt_{$day}",
            'title' => "Campaign: Q2 Launch #{$day}",
            'start' => now()->addDays($day)->format('Y-m-d\T09:00:00'),
            'end' => now()->addDays($day)->format('Y-m-d\T10:00:00'),
            'backgroundColor' => '#f97316',
            'borderColor' => '#ea580c',
            'textColor' => '#ffffff',
            'extendedProps' => ['platform' => 'twitter', 'status' => 'scheduled']
        ])->values()->toArray();
    }

    public function render()
    {
        return view('livewire.content.content-calendar');
    }
}
