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
        return view('livewire.servicios.re-paciente');
    }
}
