<?php

namespace App\Livewire\Features\Marketing;

use Livewire\Component;

class TestimonialSlider extends Component
{
    public $testimonials = [
        ['name' => 'Sarah J.', 'role' => 'E-commerce Founder', 'text' => 'AutoSocial increased our engagement by 340% in 3 months.'],
        ['name' => 'Marcus T.', 'role' => 'Marketing Director', 'text' => 'The analytics dashboard gives us insights we never had before.'],
        ['name' => 'Elena R.', 'role' => 'Personal Brand', 'text' => 'Scheduling across 5 platforms used to take hours. Now it takes minutes.'],
    ];
    
    public $currentIndex = 0;
    
    public function next() { $this->currentIndex = ($this->currentIndex + 1) % count($this->testimonials); }
    public function prev() { $this->currentIndex = ($this->currentIndex - 1 + count($this->testimonials)) % count($this->testimonials); }
    
    public function render()
    {
        return view('livewire.features.marketing.testimonial-slider');
    }
}