<form wire:submit="save" class="space-y-6">
    <div class="flex flex-col sm:flex-row items-start gap-6">
        <div class="relative group shrink-0">
            <img src="{{ $avatar ? $avatar->temporaryUrl() : $currentAvatar }}" 
                 class="h-24 w-24 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-sm" alt="Avatar">
            <label class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <input type="file" wire:model.live="avatar" class="hidden" accept="image/*">
            </label>
        </div>
        <div class="flex-1 w-full">
            <x-forms.input wire:model.live="name" label="Full Name" placeholder="Alex Morgan" />
            <x-forms.input wire:model.live="email" type="email" label="Email Address" placeholder="alex@company.com" class="mt-4" />
        </div>
    </div>

    <x-forms.textarea wire:model.live="bio" label="Bio" rows="3" placeholder="Tell us about yourself..." />

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <x-forms.select wire:model.live="timezone" label="Timezone">
            <option value="UTC">UTC</option>
            <option value="America/New_York">Eastern (ET)</option>
            <option value="America/Chicago">Central (CT)</option>
            <option value="America/Denver">Mountain (MT)</option>
            <option value="America/Los_Angeles">Pacific (PT)</option>
        </x-forms.select>
    </div>

    <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
        <x-ui.button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-70 cursor-wait">
            <span wire:loading.remove>Save Changes</span>
            <span wire:loading>Saving...</span>
        </x-ui.button>
    </div>
</form>