<?php

declare(strict_types=1);

namespace App\Livewire\Configuracion;

use App\Enums\DaysOfWeek;
use App\Livewire\Forms\Configuracion\HorarioForm;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReHorario extends Component
{
    public HorarioForm $horarioForm;

    #[Title(' - Horaio')]
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.configuracion.re-horario');
    }

    #[\Livewire\Attributes\Computed]
    public function days(): array
    {
        return DaysOfWeek::cases();
    }

    public function querySchedule(): never
    {

        app()->call($this->horarioForm->scheduleStoreUpdate(...));

    }
}
