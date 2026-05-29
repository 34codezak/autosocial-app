<?php

namespace App\Livewire\Content;

use Livewire\Component;

class PostPreview extends Component
{
    public string $content = '';
    public array $media = [];
    public array $platforms = [];
    public string $activePlatform = 'twitter';

    public function setActive(string $platform)
    {
        if (in_array($platform, $this->platforms)) $this->activePlatform = $platform;
    }

    public function render()
    {
        return view('livewire.content.post-preview');
    }
}
