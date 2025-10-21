<?php

declare(strict_types=1);

namespace App\Livewire\Configuracion;

use Livewire\Component;

final class ReFeriado extends Component
{
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.configuracion.re-feriado');
    }
}
