<?php

namespace App\Livewire\Configuracion;

use App\Livewire\Forms\Configuracion\AccesoForm;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReAcceso extends Component
{
    public AccesoForm $accesoForm;

    #[Title(' - Accesos')]
    public function render()
    {

        $this->commonQuerys = app('commonquery');

        return view('livewire.configuracion.re-acceso', [
            'listRoles' => $this->commonQuerys::listRoles(['Owner']),
        ]);
    }
}
