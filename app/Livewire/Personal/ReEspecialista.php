<?php

namespace App\Livewire\Personal;

use App\Classes\Personal\EspecialistValidation;
use App\Livewire\Forms\Personal\EspecialistaForm;
use App\Traits\HandlesActionPolicy;
use App\Traits\UtilityForm;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReEspecialista extends Component
{
    use HandlesActionPolicy,UtilityForm;

    public EspecialistaForm $formesp;

    #[Title(' - Especialista')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        $this->breadcrumbs = exploBreadcrum($this->getBreadcrumbs('Especialistas'));

        return view('livewire.personal.re-especialista', [
            'listState' => $this->commonQuerys::stateQuery([1, 2]),
            'listSpecialties' => $this->commonQuerys::listSpecialties(),
            'listDegree' => $this->commonQuerys::listDegrees(),
            'listCredential' => $this->commonQuerys::listCredentials(),
        ]);
    }

    public function getEspecialis()
    {
        $validacion = new EspecialistValidation;
        $validacion->onEspecialistCreate($this->formesp->dataespecialist);
    }
}
