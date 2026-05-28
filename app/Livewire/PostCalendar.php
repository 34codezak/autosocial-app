<?php

namespace App\Livewire;

use Livewire\Component;

class PostCalendar extends Component {
    public function render() {
        return view('livewire.analytics-dashboard')->layout('components.layouts.app');
    }
}