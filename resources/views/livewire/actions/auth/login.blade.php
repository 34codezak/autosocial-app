<div class="max-w-md mx-auto">
    <h2 class="text-2xl font-bold mb-6">Sign in to your account</h2>
    
    <form wire:submit="login" class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" wire:model="form.email" class="w-full rounded border-gray-300">
            @error('form.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" wire:model="form.password" class="w-full rounded border-gray-300">
            @error('form.password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" wire:model="form.remember" class="rounded">
                <span class="ml-2 text-sm">Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600">Forgot password?</a>
        </div>
        
        <button type="submit" class="w-full btn-primary">Sign in</button>
    </form>
    
    <p class="mt-4 text-center text-sm">
        Don't have an account? 
        <a href="{{ route('register') }}" class="text-blue-600">Sign up</a>
    </p>
</div>