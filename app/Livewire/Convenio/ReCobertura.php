<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Classes\Maestro\MainServices;
use App\Livewire\Forms\Convenio\CoberturaForm;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

final class ReCobertura extends Component
{
    public ?int $planId = null;

    public array $selectedServices = [];

    public CoberturaForm $form;

    private ?MainServices $mainServices = null;

    public function render()
    {
        return view('livewire.convenio.re-cobertura');
    }

    #[On('configCoberturas')]
    public function configCobertura($idPlan): void
    {
        $this->planId = $idPlan;
    }

    #[Computed]
    public function allServices(): array
    {
        return $this->form->serviceArray();
    }

    #[Computed]
    public function selectedServicesData()
    {
        if (empty($this->selectedServices)) {
            return collect();
        }

        return $this->form->servicesSelected($this->selectedServices);

    }
}
