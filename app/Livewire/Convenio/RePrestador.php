<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Dto\PrestadorDto;
use App\Livewire\Forms\Convenio\PrestadorForm;
use App\Models\Insurance;
use App\Models\InsuranceType;
use App\Traits\FormActionsTrait;
use App\Traits\HandlesActionPolicy;
use App\Traits\ProvinceCity;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class RePrestador extends Component
{
    use FormActionsTrait, HandlesActionPolicy, ProvinceCity,UtilityForm;

    public PrestadorForm $form;

    protected $commonQuerys;

    #[Title(' - Obra social')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view('livewire.convenio.re-prestador', [
            'listState' => $this->commonQuerys::stateQuery([1, 2]),
        ]);
    }

    public function mount(): void
    {
        $this->form->dataobrasocial ??= new PrestadorDto();
    }

    public function insuraceQuery()
    {
        $this->setIdPronvinceCity();
        $result = $this->isupdate ?
            app()->call([$this->form, 'insuranceUpdate']) :
            $this->form->insuranceStore();

        $this->endInsurance($result);

    }

    public function endInsurance($result)
    {
        $this->dispatch('show-toast', $result);
        $this->resetAllProvince();
        $this->clearForm();
    }

    public function clearForm()
    {
        $this->isupdate = false;
        $this->form->reset();
        $this->resetAllProvince();
        $this->cleanFormValues();
        $this->dispatch('showOptionsForms', show: false);

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

    public function getCountInsuranceProperty()
    {
        return Insurance::countInsurance();
    }

    #[On('dataInsurance')]
    public function InfoInsurance($insuranceId): void
    {
        $this->form->reset();

        app()->call([$this->form, 'infoInsurance'], ['idInsurance' => $insuranceId]);

        $this->setLocactionNameID(
            $this->form->getProvinceId(), $this->form->getCityId(),
            $this->form->getProvinceName(), $this->form->getCityName());

        $this->isdisabled = 'disabled';

        $this->dispatch('showOptionsForms', show: true);
    }

    public function obrasocialHandleMenuAction(string $nameoption)
    {
        $id = $this->form->dataobrasocial['id'] ?? 0;
        $this->handleAction($nameoption, [
            'id' => $id,
            'pdfClass' => 'InsurancePdf',
            'route' => 're_obrasocial',
            'model' => 'Insurance',
        ]);
    }

    protected function setIdPronvinceCity() {}
}
