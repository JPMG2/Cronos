<?php

declare(strict_types=1);

namespace App\View\Components\Convenio;

use App\Models\InsurancePlan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class PlanInfoCard extends Component
{
    public ?InsurancePlan $plan = null;

    public function __construct(public ?int $planId = null)
    {
        if ($this->planId) {
            $this->plan = InsurancePlan::planId($this->planId)->first();
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.convenio.plan-info-card');
    }
}
