<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\Attributes\Validate;

class TeamMembers extends Component
{
    #[Validate('required|email|max:255')]
    public string $inviteEmail = '';
    public string $inviteRole = 'editor';

    public array $members = [];
    public bool $showInviteForm = false;

    public function mount()
    {
        $this->members = [
            ['id' => 'm1', 'name' => 'Sarah Chen', 'email' => 'sarah@company.com', 'role' => 'admin', 'status' => 'active', 'avatar' => null],
            ['id' => 'm2', 'name' => 'Alex Rivera', 'email' => 'alex@company.com', 'role' => 'editor', 'status' => 'pending', 'avatar' => null],
            ['id' => 'm3', 'name' => 'Jordan Lee', 'email' => 'jordan@company.com', 'role' => 'viewer', 'status' => 'active', 'avatar' => null],
        ];
    }

    public function sendInvite()
    {
        $this->validate();
        // 🔌 Replace with: TeamService::invite($this->inviteEmail, $this->inviteRole);
        $this->members[] = [
            'id' => 'm_' . time(),
            'name' => '',
            'email' => $this->inviteEmail,
            'role' => $this->inviteRole,
            'status' => 'pending',
            'avatar' => null
        ];
        $this->inviteEmail = '';
        $this->showInviteForm = false;
        $this->dispatch('alert', type: 'success', message: 'Invitation sent successfully.');
    }

    public function changeRole(string $memberId, string $role)
    {
        $index = array_search($memberId, array_column($this->members, 'id'));
        if ($index !== false) $this->members[$index]['role'] = $role;
    }

    public function removeMember(string $memberId)
    {
        $this->members = array_values(array_filter($this->members, fn($m) => $m['id'] !== $memberId));
        $this->dispatch('alert', type: 'warning', message: 'Member removed from workspace.');
    }

    public function render()
    {
        return view('livewire.settings.team-members');
    }
}