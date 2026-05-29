<?php

namespace App\Livewire\Platforms;

use Livewire\Component;
use Carbon\Carbon;

class MessageInbox extends Component
{
    public string $filter = 'all';
    public array $messages = [];
    public ?array $activeMessage = null;

    public function setFilter(string $platform)
    {
        $this->filter = $platform;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        // 🔌 Replace with: UnifiedInboxService::get($this->filter)
        $this->messages = collect(range(1, 5))->map(fn($i) => [
            'id' => "msg_{$i}",
            'platform' => ['twitter', 'instagram', 'linkedin'][rand(0, 2)],
            'sender' => "User #{$i}",
            'avatar' => null,
            'preview' => "Hey! Loved your latest post about...",
            'time' => Carbon::now()->subMinutes(rand(5, 1440))->diffForHumans(),
            'unread' => rand(0, 1) === 1,
            'full_text' => "Hey! Loved your latest post about SaaS metrics. Could you share more details on how you calculate engagement rate across platforms? Thanks!"
        ])->filter(fn($m) => $this->filter === 'all' || $m['platform'] === $this->filter)->values()->toArray();
    }

    public function selectMessage(array $message)
    {
        $this->activeMessage = $message;
        $this->dispatch('message-marked-read', id: $message['id']);
    }

    public function mount() { $this->loadMessages(); }

    public function render()
    {
        return view('livewire.platforms.message-inbox');
    }
}