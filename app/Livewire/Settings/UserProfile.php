<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $bio = '';
    public string $timezone = 'UTC';
    public $avatar = null;
    public ?string $currentAvatar = null;

    public function mount()
    {
        // Replace with auth()->user()->load('media')
        $this->name = 'Alex Morgan';
        $this->email = 'alex@company.com';
        $this->bio = 'Product designer & full-stack developer.';
        $this->timezone = 'America/New_York';
        $this->currentAvatar = 'https://ui-avatars.com/api/?name=Alex+Morgan&background=orange&color=fff';
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string|max:500',
            'timezone' => 'required|string',
            'avatar' => 'nullable|image|max:2048|mimes:jpeg,png,webp',
        ]);

        // Replace with: auth()->user()->update($this->only('name', 'email', 'bio', 'timezone'));
        if ($this->avatar) {
            // $this->avatar->storePublicly('avatars');
        }

        $this->dispatch('profile-updated');
        $this->dispatch('alert', type: 'success', message: 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.settings.user-profile');
    }
}
