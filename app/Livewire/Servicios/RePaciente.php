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
        ]);
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
        app()->call([$this->pacienteForm, 'pacienteStore']);
    }
}
