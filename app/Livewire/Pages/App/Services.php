<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;
use App\Services\PlatformServicesService;

class Services extends Component
{
    public $availableServices;
    
    public function mount(PlatformServicesService $service)
    {
        $this->availableServices = $service->getAvailableForUser(auth()->user());
    }
    
    public function toggleService($serviceId)
    {
        // Implementation for enabling/disabling services
        $this->dispatch('notify', message: 'Service updated');
    }
    
    public function render()
    {
        return view('livewire.pages.app.services')
            ->layout('layouts.app', ['title' => 'Services']);
    }
}