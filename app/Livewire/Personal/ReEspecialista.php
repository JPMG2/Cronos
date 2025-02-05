<?php

namespace App\Livewire\Personal;

use App\Traits\HandlesActionPolicy;
use App\Traits\UtilityForm;
use Livewire\Component;
use Livewire\Attributes\Title;

class ReEspecialista extends Component
{
    use HandlesActionPolicy,UtilityForm;
    #[Title(' - Especialista')]
    public function render()
    {
        $this->breadcrumbs = exploBreadcrum($this->getBreadcrumbs('Especialistas'));
        return view('livewire.personal.re-especialista');
    }
}
