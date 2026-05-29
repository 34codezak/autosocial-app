<?php

namespace App\Livewire\Platforms;

use Livewire\Component;

class PostPublisher extends Component
{
    public string $status = 'idle'; // idle, validating, processing, success, error
    public string $message = '';
    public array $targets = [];
    public ?string $contentId = null;

    public function publish()
    {
        if (empty($this->targets)) {
            $this->status = 'error';
            $this->message = 'No publishing targets selected.';
            return;
        }

        $this->status = 'validating';
        // 🔌 Replace with: $this->validate();
        $this->status = 'processing';
        $this->message = 'Dispatching to background queue...';

        // Simulate async job dispatch
        $this->dispatch('post-publish-job', contentId: 'draft_123', targets: $this->targets);
        
        $this->status = 'success';
        $this->message = 'Post successfully queued for publishing!';
    }

    public function render()
    {
        return view('livewire.platforms.post-publisher');
    }
}