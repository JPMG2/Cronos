<?php

namespace App\Livewire\Gestion;

use App\Livewire\Forms\Gestion\ObraSocialForm;
use App\Models\Insurance;
use App\Models\InsuranceType;
use App\Traits\FormActionsTrait;
use App\Traits\HandlesActionPolicy;
use App\Traits\ProvinceCity;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReObraSocail extends Component
{
    use FormActionsTrait, HandlesActionPolicy, ProvinceCity,UtilityForm;

    public ObraSocialForm $form;

    protected $commonQuerys;

    #[Title(' - Obra social')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view('livewire.gestion.re-obra-social', [
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
            $result = app()->call([$this->form, 'insuranceUpdate']);
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

    public function getCountInsuranceProperty()
    {
        return Insurance::countInsurance();
    }

    public function getTypesProperty()
    {
        return InsuranceType::listType()->get();
    }

    public function clearForm()
    {
        $this->isupdate = false;
        $this->form->reset();
        $this->resetAllProvince();
        $this->cleanFormValues();
        $this->dispatch('showOptionsForms', show: false);

    }

    public function endInsurance($result)
    {
        $this->dispatch('show-toast', $result);
        $this->resetAllProvince();
        $this->clearForm();
    }

    #[On('dataInsurance')]
    public function InfroInsurance($insuranceId)
    {
        $this->form->reset();

        app()->call([$this->form, 'infoInsurance'], ['idInsurance' => $insuranceId]);

        $this->IdandNames(
            $this->form->getProvinceId(), $this->form->getCityId(),
            $this->form->getProvinceName(), $this->form->getCityName());

        $this->isdisabled = 'disabled';

        $this->dispatch('showOptionsForms', show: true);
    }

    public function obrasocialHandleMenuAction(string $nameoption)
    {
        $id = $this->form->dataobrasocial['id'] ?? 0;
        $this->handleAction($nameoption, [$id, 'InsurancePdf', 're_obrasocial', 'Insurance']);
    }
}
