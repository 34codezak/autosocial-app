<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;
use App\Services\DashboardMetricsService;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Component
{
    public $metrics;
    
    # The Component's mount method is called when the component is first instantiated. It initializes the metrics property by calling the resolveMetrics method with the provided DashboardMetricsService instance. 
    public function mount(DashboardMetricsService $service)
    { # Any arguments defined here are automatically dependency-injected by Laravel's service container. In this case, the DashboardMetricsService is injected into the mount method.
        $this->metrics = $this->resolveMetrics($service); 
        # This promotes loose coupling, meaning the component doesn't need to know how to create the service, just that it exists. 
    } 


    protected function resolveMetrics(DashboardMetricsService $service)
    {
        $user = Auth::user();

        if (method_exists($service, 'getSummary')) {
            return $service->getSummary($user);
        }

        if (method_exists($service, 'summary')) {
            return $service->summary($user);
        }

        if (method_exists($service, 'getMetrics')) {
            return $service->getMetrics($user);
        }

        return [];
    }
    
    protected string $layout = 'layouts.app';
    protected array $layoutData = ['title' => 'Dashboard'];

    public function render()
    {
        return view('livewire.pages.app.dashboard');
    }
}