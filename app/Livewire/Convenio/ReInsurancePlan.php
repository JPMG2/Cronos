<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use Livewire\Attributes\Title;
use Livewire\Component;

final class ReInsurancePlan extends Component
{
    #[Title(' - Planes')]
    public function render()
    {
        return view('livewire.convenio.re-insurance-plan');
    }
}
