<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Classes\Utilities\CommonQuerys;
use App\Livewire\Forms\Convenio\PrestadorPlanForm;
use App\Traits\FormHandling;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

final class ModalPrestadorPlan extends Component
{
    use FormHandling;

    #[Locked]
    public $idInsurance;

    public bool $show = false;

    public PrestadorPlanForm $form;

    public ?string $searchPrestador = null;

    public $listPrestadores = [];

    #[On('showModalPrestadorPlan')]
    public function handleOpenModal(?int $id): void
    {
        $this->idInsurance = $id;
        $this->openModal();
        if ($this->idInsurance !== null) {
            $this->isupdate = true;
            $this->form->prestadorPlanData($this->idInsurance);
        }
    }

    public function openModal(): void
    {
        $this->show = true;
        $this->clearForm();
        $this->dispatch('focus-first-input');
    }

    public function submitPrestadorPlan(): void
    {
        $result = $this->isupdate ?
            $this->form->prestadorPlanUpdate() :
            $this->form->prestadorPlanStore();

        $messageType = $this->isupdate ? 'msgUpdate' : 'msgCreate';
        $message = $this->showQueryMessage($result, $messageType);
        $this->showToastAndClear($message);
        $this->closeModal();
    }

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
        $this->dispatch('clear-errors');

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

    public function insurances()
    {
        return CommonQuerys::Insurances([1], $this->searchPrestador);
    }

    private function clearForm(): void
    {
        $this->listPrestadores = [];
        $this->form->reset();
    }
}
