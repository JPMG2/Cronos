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

    public $searchPrestador = null;

    public $listPrestadores = [];

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

    public function submitPrestadorPlan(): void {}

    public function closeModal(): void
    {
        $this->show = false;
        $this->clearForm();
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

    public function updatedFormDataPrestadorPlanInsuranceName($value)
    {
        if (str()->length($value) >= 2) {
            $this->searchPrestador = $value;

            $this->listPrestadores = $this->insurances();

        } else {
            $this->listPrestadores = [];
        }
    }

    #[Computed]
    public function insurances()
    {

        return CommonQuerys::Insurances([1], $this->searchPrestador);
    }

    private function clearForm(): void
    {
        $this->form->reset();
    }
}
