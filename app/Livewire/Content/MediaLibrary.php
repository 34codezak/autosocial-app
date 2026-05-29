<?php

namespace App\Livewire\Content;

use Livewire\Component; 
use Livewire\WithFileUploads;

class MediaLibrary extends Component {
    use WithFileUploads;

    public array $mediaFiles = [];
    public array $selectedIds = [];
    public bool $isDragging = false;

    public function mount() {
        // Replace with: $this->mediaFiles = auth()->user()->media()->latest()->get();
        $this->mediaFiles = collect(range(1, 6))->map(fn($i) => [
            'id' => "img_{$i}",
            'url' => "https://source.unsplash.com/random/400x400?sig={$i}",
            'name' => "image_{$i}.jpg",
        ])->toArray();
    }

    public function toggleSelect(string $id) {
        $this->selectedIds = in_array($id, $this->selectedIds) ? array_diff($this->selectedIds, [$id]) : [...$this->selectedIds, $id];
    }

    public function render() {
        return view('livewire.content.media-library');
    }

}
