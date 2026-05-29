<div class="space-y-6">
    <h1 class="text-2xl font-bold">Dashboard</h1>
    
    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @foreach($metrics as $key => $value)
            <div class="bg-white p-4 rounded-lg shadow">
                <dt class="text-sm text-gray-500">{{ ucfirst($key) }}</dt>
                <dd class="text-2xl font-bold">{{ $value }}</dd>
            </div>
        @endforeach
    </div>
    
    <!-- Quick Actions -->
    <div class="flex gap-3">
        <a href="{{ route('app.dashboard.editor') }}" class="btn-primary">Create Post</a>
        <a href="{{ route('app.dashboard.calendar') }}" class="btn-secondary">View Calendar</a>
    </div>
    
    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
        <p class="text-gray-500">No recent activity to display.</p>
    </div>
</div>