<?php

namespace App\Livewire\Content;

use Livewire\Component;
use Livewire\WithFileUploads;

class PostComposer extends Component
{
    use WithFileUploads;

    public string $content = '';
    public array $media = [];
    public array $selectedPlatforms = [];
    public bool $scheduling = false;
    public ?string $scheduledAt = null;
    public string $timezone = 'UTC';

    public array $platforms = [
        ['id' => 'twitter', 'name' => 'Twitter/X', 'limit' => 280, 'icon' => '🐦'],
        ['id' => 'linkedin', 'name' => 'LinkedIn', 'limit' => 3000, 'icon' => '💼'],
        ['id' => 'instagram', 'name' => 'Instagram', 'limit' => 2200, 'icon' => '📷'],
    ];

    public function togglePlatform(string $id)
    {
        $this->selectedPlatforms = in_array($id, $this->selectedPlatforms)
            ? array_diff($this->selectedPlatforms, [$id])
            : [...$this->selectedPlatforms, $id];
    }

    public function getRemainingChars(): int
    {
        $limit = collect($this->platforms)->whereIn('id', $this->selectedPlatforms)->min('limit');
        return $limit ? $limit - strlen($this->content) : 0;
    }

    public function save()
    {
        // 🔌 Replace with: app(PostService::class)->create($this->toArray());
        $this->dispatch('post-saved', id: 'draft_' . now()->timestamp);
        $this->reset(['content', 'media', 'selectedPlatforms', 'scheduledAt']);
        $this->dispatch('close-composer');
    }

    public function render()
    {
        return view('livewire.content.post-composer');
    }
}
