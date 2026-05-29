<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class QuickActions extends Component
{
    // Purely frontend-driven via Alpine, but kept as Livewire for future auth/gate integration
    public function render()
    {
        return view('livewire.dashboard.quick-actions');
    }
}
