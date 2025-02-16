<?php

namespace App\Livewire\Gestion;

use App\Livewire\Forms\Gestion\ObraSocialForm;
use App\Models\InsuranceType;
use App\Traits\HandlesActionPolicy;
use App\Traits\ProvinceCity;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ObraSocailRegistro extends Component
{
    use HandlesActionPolicy, ProvinceCity, UtilityForm;

    public ObraSocialForm $form;

    protected $commonQuerys;

    #[Title(' - Obra social')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view('livewire.gestion.obra-socail-registro', [
            'listState' => $this->commonQuerys::stateQuery([1, 2]),
        ]);
    }

    public function insuraceQuery()
    {
        $this->setIdPronvinceCity();
        if (! $this->isupdate) {
            $result = app()->call([$this->form, 'insuranceStore']);
        }
        if ($this->isupdate) {
            dd('update');
        }
        $this->endInsurance($result);

    }

    protected function setIdPronvinceCity()
    {
        $this->form->dataobrasocial['city_id'] = max($this->getCityId(), 0);
        $this->form->dataobrasocial['province_id'] = max($this->getProvinceId(),
            0);
    }

    public function openTypes()
    {
        $this->dispatch('showTypesModal');
    }

    #[On('reloadInsuraceType')]
    public function reloadInsuraceType()
    {
        $this->getTypesProperty();

    }

    public function getTypesProperty()
    {
        return InsuranceType::listType()->get();
    }

    public function clearForm()
    {
        $this->isupdate = false;
        $this->form->reset();
        $this->cleanFormValues();
        $this->dispatch('showOptionsForms', show: false);
    }

    public function endInsurance($result)
    {
        $this->dispatch('show-toast', $result);
        $this->clearForm();
    }
}
