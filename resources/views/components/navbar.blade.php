<!-- Inside resources/views/components/navbar.blade.php -->
<div class="hidden md:flex items-center space-x-6">
    <x-nav-link :href="route('workspace')" :active="request()->routeIs('workspace.*')">
        Workspace
    </x-nav-link>
    
    <x-nav-link :href="route('services')" :active="request()->routeIs('services.*')">
        Services
    </x-nav-link>
    
    <x-nav-link :href="route('pricing')" :active="request()->routeIs('pricing.*')">
        Pricing
    </x-nav-link>

</div>