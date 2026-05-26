<?php

namespace App\Livewire\Marketing;

use Livewire\Component;

class NewsletterSignup extends Component
{
    public string $email = '';
    
    public function subscribe(): void
    {
        $this->validate(['email' => 'required|email']);
        
        // TODO: Add to newsletter service
        // Newsletter::subscribe($this->email);
        
        $this->dispatch('newsletter-subscribed');
        $this->reset('email');
    }
    
    public function render()
    {
        return view('livewire.marketing.newsletter-signup');
    }
}