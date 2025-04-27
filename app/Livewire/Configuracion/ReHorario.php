<?php

declare(strict_types=1);

namespace App\Livewire\Configuracion;

use App\Enums\DaysOfWeek;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReHorario extends Component
{
    #[Title(' - Horaio')]
    public function render()
    {
        return view('livewire.configuracion.re-horario');
    }

    public function getDaysProperty()
    {
        return DaysOfWeek::cases();
    }
}
