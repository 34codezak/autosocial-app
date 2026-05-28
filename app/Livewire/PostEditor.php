<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PostEditor extends Component
{

    use WithFileUploads;

    public string $content = '';
    public array $platForms = [];
    public ?string $scheduleAt = null;
    public $media = null;
    public bool $isPreviewOpen = true;

    public array $availablePlatforms = [
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'twitter' => 'X (Twitter)',
        'linkedin' => 'LinkedIn',
        'tiktok' => 'Tiktok',
    ];

    public function rules() {
        return [
            'content' => 'required|min:10|max:5000',
            'platforms' => 'required|array|min:1',
            'scheduledAt' => 'nullable|date|after:' . now()->addMinutes(5)->toDateTimeString(),
            'media' => 'nullable|mimes:jpg,png,mp4,gif|max:10240',
        ];
    }

    public function mount() {
        $this->platforms = array_keys($this->availablePlatforms);
    }

    public function updatedMedia() {
        $this->validatedOnly('media');
    }

    public function togglePlatform(string $platform) {
        if(in_array($platform, $this->platforms)) {
            $this->platforms = array_filter($this->platforms, fn($p) => $p !== $platform);
        }else{
            $this->platforms[] = $platfrom;
        }
    }

    public function saveDraft() {
        $this->validate();
        // TODO: $this->dispatch('post-saved), type: 'draft', data: [...]};
        $this->dispatch('notify', message: 'Draft saved successfully!', type: 'success');
    }

    public function scheduleOrPublish() {
        $this->validate();
        $status = $this->scheduleAt ? 'schedule' : 'published';

        // TODO: Save to DB $ queue job if scheduled
        $this->dispatch('notify', message: ucfirst($status) . ' successfully!', type: 'success');
        $this->reset(['content', 'media', 'scheduleAt']);
        $this->platforms = array_keys($this->validatePlatforms);
    }

    public function render()
    {
        return view('livewire.post-editor')->layout('components.layouts.app');
    }
}
