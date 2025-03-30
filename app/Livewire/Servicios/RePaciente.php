<?php

declare(strict_types=1);

namespace App\Livewire\Servicios;

use App\Livewire\Forms\Servicios\PacienteForm;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

final class RePaciente extends Component
{
    public PacienteForm $pacienteForm;

    #[Title(' - Pacientes')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view('livewire.servicios.re-paciente', [
            'listDocument' => $this->commonQuerys::listDocuments(),
            'listGender' => $this->commonQuerys::listGenders(),
            'listMaritalStatus' => $this->commonQuerys::listMaritalStatus(),
            'listNationality' => $this->commonQuerys::listNacionalidad(),
        ]);
    }

    #[Computed]
    public function ocupacion()
    {
        // dd($this->pacienteForm->pacienteData['occupation_id']);
        $this->commonQuerys = app('commonquery');

        return $this->commonQuerys::listOcupacion($this->pacienteForm->pacienteData['occupation_id']);
    }

    public function getPaciente()
    {
        dd($this->pacienteForm->pacienteData);
    }

    public function computedUpdate($computename)
    {
        $this->$computename();
    }
}
