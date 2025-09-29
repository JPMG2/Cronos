<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Classes\Utilities\CommonQuerys;
use App\Livewire\Forms\Convenio\PrestadorPlanForm;
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
        $this->clearForm();
    }

    public function submitPrestadorPlan(): void
    {
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->clearForm();
    }

    #[Computed]
    public function insurances()
    {
        return CommonQuerys::Insurances([1]);
    }

    #[Computed]
    public function states()
    {
        return CommonQuerys::stateQuery([1, 2]);
    }

    public function render()
    {
        return view('livewire.convenio.modal-prestador-plan');
    }

    private function clearForm(): void
    {
        $this->form->reset();
    }
}
