<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Models\Insurance;
use App\Models\InsurancePlan;
use App\Models\State;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

final class ModalPrestadorPlan extends Component
{
    public bool $show = false;

    public int $insurance_id = 0;

    public string $state_id = '';

    public string $insurance_plan_name = '';

    public string $insurance_plan_code = '';

    public string $insurance_plan_description = '';

    public bool $authorisation = false;

    protected array $rules = [
        'insurance_id' => 'required|integer|exists:insurances,id',
        'state_id' => 'required|string|exists:states,id',
        'insurance_plan_name' => 'required|string|max:255',
        'insurance_plan_code' => 'required|string|max:255',
        'insurance_plan_description' => 'nullable|string',
        'authorisation' => 'boolean',
    ];

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

    public function save(): void
    {
        $this->validate();

        InsurancePlan::create([
            'insurance_id' => $this->insurance_id,
            'state_id' => $this->state_id,
            'insurance_plan_name' => $this->insurance_plan_name,
            'insurance_plan_code' => $this->insurance_plan_code,
            'insurance_plan_description' => $this->insurance_plan_description,
            'authorisation' => $this->authorisation,
        ]);

        $this->closeModal();
        $this->dispatch('insurance-plan-saved');
        session()->flash('success', 'Plan de seguro creado exitosamente.');
    }

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
        return State::orderBy('state_name')->get();
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
