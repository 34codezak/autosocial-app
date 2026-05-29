<x-layouts.settings title="Settings" :navigation="$navigation">
    @if(request()->is('settings/profile'))
        <livewire:settings.user-profile />
    @elseif(request()->is('settings/notifications'))
        <livewire:settings.notification-prefs />
    @elseif(request()->is('settings/connected-accounts'))
        <livewire:settings.connected-accounts />
    @elseif(request()->is('settings/team'))
        <livewire:settings.team-members />
    @elseif(request()->is('settings/api-keys'))
        <livewire:settings.api-keys />
    @endif
</x-layouts.settings>