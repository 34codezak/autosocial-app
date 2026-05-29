<?php

namespace App\Livewire\Features\Marketing;

use Livewire\Component;

class Demo extends Component
{
    public $name, $email, $company, $message;
    
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'company' => 'nullable',
        'message' => 'nullable|max:500',
    ];
    
    public function requestDemo()
    {
        $this->validate();
        // Send to CRM / sales team
        $this->dispatch('notify', message: 'Demo request received! We\'ll contact you within 24h.');
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.features.marketing.demo');
    }
}