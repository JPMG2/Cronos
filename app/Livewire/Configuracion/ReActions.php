<?php

namespace App\Livewire\Configuracion;

use App\Livewire\Forms\Configuracion\ActionsForm;
use App\Traits\UtilityForm;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReActions extends Component
{
    use UtilityForm;

    public ActionsForm $actionForm;

    #[Title(' - Permisos')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view('livewire.configuracion.re-actions', [
            'listRoles' => $this->commonQuerys::listRoles(['Owner']),
            'listActions' => $this->commonQuerys::listActions(['login', 'logout']),
        ]);
    }

    public function queryActionRole()
    {
        dd($this->actionForm->dataaction);
    }
}
