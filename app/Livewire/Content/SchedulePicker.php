<?php

namespace App\Livewire\Content;

use Livewire\Component;
use Carbon\Carbon;

class SchedulePicker extends Component
{
    public ?string $date = null;
    public ?string $time = '09:00';
    public string $timezone = 'UTC';
    public array $presets = [
        'now' => 'Immediately',
        'tomorrow_9am' => 'Tomorrow 9AM',
        'best_time' => 'Optimal Time',
    ];
    public string $selectedPreset = '';

    public function selectPreset(string $key)
    {
        $this->selectedPreset = $key;
        $this->date = match($key) {
            'now' => now()->format('Y-m-d'),
            'tomorrow_9am' => now()->addDay()->format('Y-m-d'),
            'best_time' => now()->addHours(2)->format('Y-m-d'),
            default => $this->date,
        };
        $this->dispatch('schedule-updated', date: $this->date, time: $this->time, timezone: $this->timezone);
    }

    public function updated()
    {
        $this->dispatch('schedule-updated', date: $this->date, time: $this->time, timezone: $this->timezone);
    }

    public function render()
    {
        return view('livewire.content.schedule-picker');
    }
}
