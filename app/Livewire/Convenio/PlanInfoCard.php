<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Models\InsurancePlan;
use Livewire\Attributes\On;
use Livewire\Component;

final class PlanInfoCard extends Component
{
    public ?int $planId = null;

    #[On('configCoberturas')]
    public function updatePlan($idPlan): void
    {
        $this->planId = $idPlan;
    }

    public function render()
    {
        $plan = null;
        if ($this->planId) {
            $plan = InsurancePlan::planId($this->planId)->first();
        }

        return view('livewire.convenio.plan-info-card', [
            'plan' => $plan,
        ]);
    }
}
