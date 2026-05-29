<form wire:submit="save" class="space-y-8">
    <div class="space-y-4">
        <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Email</h4>
        <div class="space-y-3 divide-y divide-gray-100 dark:divide-gray-700">
            <div class="flex items-center justify-between py-3">
                <div>
                    <p class="font-medium text-gray-800 dark:text-gray-200">Marketing & Updates</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Receive tips, product updates, and promotions.</p>
                </div>
                <x-ui.toggle wire:model.live="prefs.email_marketing" name="email_marketing" />
            </div>
            <div class="flex items-center justify-between py-3">
                <div>
                    <p class="font-medium text-gray-800 dark:text-gray-200">Weekly Reports</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Summary of your account analytics every Monday.</p>
                </div>
                <x-ui.toggle wire:model.live="prefs.email_reports" name="email_reports" />
            </div>
            <div class="flex items-center justify-between py-3">
                <div>
                    <p class="font-medium text-gray-800 dark:text-gray-200">Team Activity</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Notifications when teammates post or modify schedules.</p>
                </div>
                <x-ui.toggle wire:model.live="prefs.email_team" name="email_team" />
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Push & In-App</h4>
        <div class="space-y-3 divide-y divide-gray-100 dark:divide-gray-700">
            <div class="flex items-center justify-between py-3">
                <div>
                    <p class="font-medium text-gray-800 dark:text-gray-200">Mentions & Replies</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Get notified when someone engages with your posts.</p>
                </div>
                <x-ui.toggle wire:model.live="prefs.push_mentions" name="push_mentions" />
            </div>
            <div class="flex items-center justify-between py-3">
                <div>
                    <p class="font-medium text-gray-800 dark:text-gray-200">Scheduled Posts</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Alerts 1 hour before posts go live.</p>
                </div>
                <x-ui.toggle wire:model.live="prefs.push_scheduled" name="push_scheduled" />
            </div>
        </div>
    </div>

    <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
        <x-ui.button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-70 cursor-wait">
            <span wire:loading.remove>Save Preferences</span>
            <span wire:loading>Saving...</span>
        </x-ui.button>
    </div>
</form>