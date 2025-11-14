<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Models\InsurancePlan;
use Livewire\Attributes\On;
use Livewire\Component;

final class ReCobertura extends Component
{
    public ?InsurancePlan $idPlan;

    public function render()
    {
        return view('livewire.convenio.re-cobertura');
    }

    #[On('configCoberturas')]
    public function configCobertura($idPlan)
    {
        $this->idPlan = InsurancePlan::find($idPlan);

    }
}
