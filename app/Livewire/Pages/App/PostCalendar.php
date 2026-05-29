<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;
use App\Models\Post;
use Carbon\Carbon;

class PostCalendar extends Component
{
    public $currentMonth;
    public $posts = [];
    
    public function mount()
    {
        $this->currentMonth = Carbon::now()->startOfMonth();
        $this->loadPosts();
    }
    
    public function loadPosts()
    {
        $this->posts = auth()->user()->posts()
            ->whereMonth('scheduled_at', $this->currentMonth->month)
            ->whereYear('scheduled_at', $this->currentMonth->year)
            ->with('socialAccounts')
            ->get()
            ->groupBy(function ($post) {
                return $post->scheduled_at->format('Y-m-d');
            });
    }
    
    public function changeMonth($direction)
    {
        $this->currentMonth = $direction === 'next' 
            ? $this->currentMonth->addMonth() 
            : $this->currentMonth->subMonth();
        $this->loadPosts();
    }
    
    public function render()
    {
        return view('livewire.pages.app.post-calendar')
            ->layout('layouts.app', ['title' => 'Content Calendar']);
    }
}