<?php

declare(strict_types=1);

namespace App\Livewire\Servicios;

use Livewire\Attributes\Title;
use Livewire\Component;

final class RePaciente extends Component
{
    #[Title(' - Pacientes')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view('livewire.servicios.re-paciente', [
            'listDocument' => $this->commonQuerys::listDocuments(),
            'listGender' => $this->commonQuerys::listGenders(),
        ]);
    }
}
