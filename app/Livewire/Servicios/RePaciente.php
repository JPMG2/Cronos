<?php

declare(strict_types=1);

namespace App\Livewire\Servicios;

use App\Livewire\Forms\Servicios\PacienteForm;
use App\Models\Patient;
use App\Traits\FormActionsTrait;
use App\Traits\UtilityForm;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class RePaciente extends Component
{
    use FormActionsTrait, UtilityForm;

    public PacienteForm $pacienteForm;

    #[Title(' - Pacientes')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view('livewire.servicios.re-paciente', [
            'listDocument' => $this->commonQuerys::listDocuments(),
            'listGender' => $this->commonQuerys::listGenders(),
            'listMaritalStatus' => $this->commonQuerys::listMaritalStatus(),
        ]);
    }

    #[Computed]
    public function numpatients()
    {
        return Patient::query()->count();
    }

    #[Computed]
    public function ocupacion()
    {

        $this->commonQuerys = app('commonquery');

        return $this->commonQuerys::listOcupacion();
    }

    #[Computed]
    public function nationality()
    {

        $this->commonQuerys = app('commonquery');

        return $this->commonQuerys::listNacionalidad();
    }

    public function getPaciente()
    {
        if (! $this->isupdate) {
            $result = app()->call([$this->pacienteForm, 'pacienteStore']);
        }
        $this->endPatient($result);
    }

    public function endPatient($result)
    {
        $this->dispatch('show-toast', $result);
        $this->clearForm();
    }

    public function clearForm()
    {
        $this->pacienteForm->reset();
        $this->cleanFormValues();
    }

    public function validateDocument()
    {
        app()->call([$this->pacienteForm, 'validateDocumente'], ['typeQuery' => $this->isupdate]);
    }

    public function patientHandleMenuAction(string $nameoption)
    {

        $id = $this->pacienteForm->pesonData['id'] ?? 0;
        $this->handleAction($nameoption, [
            'id' => $id,
            'pdfClass' => 'MedicPdf',
            'route' => 're_paciente',
            'model' => 'Patient',
        ]);
    }

    #[On('dataPatient')]
    public function loadPatiente($show)
    {
        $this->show = $show;
    }
}
