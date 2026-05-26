<div class="max-w-md mx-auto">
    <form wire:submit="subscribe" class="flex gap-2">
        <input 
            type="email" 
            wire:model="email"
            placeholder="Enter your email"
            class="flex-1 px-4 py-2 border rounded-lg"
        >
        <button 
            type="submit"
            class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700"
        >
            Subscribe
        </button>
    </form>
    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>