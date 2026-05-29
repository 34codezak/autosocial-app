<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;

class PostEditor extends Component
{
    use WithFileUploads;
    
    public $title, $content, $scheduled_at, $platforms = [];
    public $media = [];
    
    protected $rules = [
        'title' => 'required|max:200',
        'content' => 'required|max:5000',
        'platforms' => 'required|array|min:1',
    ];
    
    public function save()
    {
        $this->validate();
        
        $post = auth()->user()->posts()->create([
            'title' => $this->title,
            'content' => $this->content,
            'scheduled_at' => $this->scheduled_at,
            'platforms' => $this->platforms,
        ]);
        
        if ($this->media) {
            foreach ($this->media as $file) {
                $post->addMedia($file)->toMediaCollection('attachments');
            }
        }
        
        $this->dispatch('notify', message: 'Post scheduled successfully!');
        $this->reset(['title', 'content', 'scheduled_at', 'platforms', 'media']);
    }
    
    public function render()
    {
        return view('livewire.pages.app.post-editor')
            ->layout('layouts.app', ['title' => 'Post Editor']);
    }
}