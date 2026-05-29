<?php
// app/Livewire/Actions/Marketing/Contact.php

use Livewire\Volt\Component;

new class extends Component {
    public $name, $email, $subject, $message;
    
    protected $rules = [
        'name' => 'required|max:100',
        'email' => 'required|email',
        'subject' => 'required|max:200',
        'message' => 'required|max:2000',
    ];
    
    public function send()
    {
        $this->validate();
        
        // Send email via Mail::to()->send()
        $this->dispatch('notify', message: 'Message sent! We\'ll reply within 24 hours.');
        $this->reset();
    }
    
    public function render() {
        return view('livewire.actions.marketing.contact');
    }
};