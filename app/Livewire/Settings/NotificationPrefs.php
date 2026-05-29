<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class NotificationPrefs extends Component {
    public array $prefs = [
        'email_marketing' => true,
        'email_reports' => true,
        'email_team' => false,
        'push_mentions' => true,
        'push_scheduled' => true,
        'push_system' => false,
        'weekly_digest' => true,
    ];

    public function save() 
    {
        // 🔌 Replace with: auth()->user()->update(['notification_prefs' => $this->prefs]);
        $this->dispatch('notification-prefs-updated');
        $this->dispatch('alert', type: 'success', message: 'Notification preferences saved.');
    }

    public function render() 
    {
        return view('livewire.settings.notification-prefs');
    }
}
