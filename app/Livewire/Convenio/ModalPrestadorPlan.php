<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Classes\Utilities\CommonQuerys;
use App\Livewire\Forms\Convenio\PrestadorPlanForm;
use App\Models\Insurance;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

final class ModalPrestadorPlan extends Component
{
    public bool $show = false;

    public PrestadorPlanForm $form;

    #[On('showModalPrestadorPlan')]
    public function handleOpenModal(): void
    {
        $this->openModal();
    }

    public function openModal(): void
    {
        $this->show = true;
        $this->resetForm();
    }

    public function submitPrestadorPlan(): void {}

    public function closeModal(): void
    {
        $this->show = false;
        $this->resetForm();
    }

    #[Computed]
    public function insurances()
    {
        return Insurance::orderBy('insurance_name')->get();
    }

    #[Computed]
    public function states()
    {
        return CommonQuerys::stateQuery([1, 2, 3]);
    }

    public function render()
    {
        return view('livewire.convenio.modal-prestador-plan');
    }

    private function resetForm(): void
    {
        $this->insurance_id = 0;
        $this->state_id = '';
        $this->insurance_plan_name = '';
        $this->insurance_plan_code = '';
        $this->insurance_plan_description = '';
        $this->authorisation = false;
        $this->resetErrorBag();
    }
}
