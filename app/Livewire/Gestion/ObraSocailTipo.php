<?php

namespace App\Livewire\Gestion;

use App\Livewire\Forms\Gestion\ObraSocialTypeForm;
use App\Models\InsuranceType;
use Livewire\Attributes\On;
use Livewire\Component;

class ObraSocailTipo extends Component
{
    public $show = false;

    public ObraSocialTypeForm $formtype;

    public function getTypesProperty()
    {
        return InsuranceType::listType()->get();
    }

    public function render()
    {
        return view('livewire.gestion.obra-socail-tipo');
    }

    public function queryInsuraceType()
    {
        dd($this->formtype->insuratype_name);

        $result = app()->call([$this->formtype, 'insuratypeStore']);
        $this->dispatch('show-toast', $result);
        $this->dispatch('reloadInsuraceType');
        $this->clearForm();
        $this->toggleModal();
    }

    #[On('showTypesModal')]
    public function toggleModal()
    {
        $this->show = ! $this->show;
    }

    public function clearFormChild()
    {

        $this->formtype->reset('insuratype_name');
        $this->resetErrorBag();
    }
}
