<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Livewire\Forms\Convenio\ObraSocialTypeForm;
use App\Models\InsuranceType;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Component;

final class ObraSocialTipo extends Component
{
    use UtilityForm;

    public $show = false;

    public ObraSocialTypeForm $formtype;

    public function getTypesProperty()
    {
        return InsuranceType::listType()->get();
    }

    public function render()
    {
        return view('livewire.convenio.obra-social-tipo');
    }

    public function queryInsuraceType()
    {

        if (! $this->isupdate) {
            $result = app()->call([$this->formtype, 'insuratypeStore']);
        } else {
            $result = app()->call([$this->formtype, 'insuratypeUpdate']);
        }

        $this->endInsuraceType($result);
    }

    public function endInsuraceType($result)
    {
        $this->dispatch('show-toast', $result);
        $this->dispatch('reloadInsuraceType');
        $this->clearFormChild();
        $this->toggleModal();
        $this->isupdate = false;
    }

    public function clearFormChild()
    {
        $this->formtype->reset();
        $this->resetErrorBag();
        $this->isupdate = false;
    }

    #[On('showTypesModal')]
    public function toggleModal()
    {
        $this->show = ! $this->show;
    }

    public function insuranceInfo($idInsuraType)
    {
        $this->isupdate = true;
        $result = app()->call([$this->formtype, 'insuranceData'], ['idInsuraType' => $idInsuraType]);
    }
}
