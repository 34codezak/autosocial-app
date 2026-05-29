<?php

namespace App\Livewire\Marketing;

use Livewire\Component;

class PricingTable extends Component
{

    public $plans = [
        ['name' => 'Starter', 'price' => 29, 'features' => ['3 social accounts', '50 posts/month', 'Basic analytics']],
        ['name' => 'Growth', 'price' => 79, 'features' => ['10 social accounts', 'Unlimited posts', 'Advanced analytics', 'Team collaboration']],
        ['name' => 'Enterprise', 'price' => 199, 'features' => ['Unlimited accounts', 'Custom integrations', 'Dedicated support', 'SLA guarantee']],
    ];

    public $selctedPlan;

    public function selectedPlan($planName) {
        $this->selectedPlan = $planName;
        $this->dispatch('plan-sected', plan: $planName);
    }

    public function render()
    {
        return view('livewire.marketing.pricing-table');
    }
}
