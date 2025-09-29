<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Dto\PrestadorDto;
use App\Livewire\Forms\Convenio\PrestadorForm;
use App\Models\Insurance;
use App\Models\InsuranceType;
use App\Traits\FormHandling;
use App\Traits\HandlesActionPolicy;
use App\Traits\ProvinceCity;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class RePrestador extends Component
{
    use FormHandling;
    use HandlesActionPolicy;
    use ProvinceCity;

    public PrestadorForm $form;

    private $commonQuerys;

    #[Title(' - Obra social')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view(
            'livewire.convenio.re-prestador',
            [
                'listState' => $this->commonQuerys::stateQuery([1, 2]),
            ]
        );
    }

    public function mount(): void
    {
        $this->form->dataobrasocial ??= new PrestadorDto();
    }

    public function insuraceQuery(): void
    {
        $this->setIdPronvinceCity();
        $result = $this->isupdate ?
            $this->form->insuranceUpdate() :
            $this->form->insuranceStore();
        $messageType = $this->isupdate ? 'msgUpdate' : 'msgCreate';
        $message = $this->showQueryMessage($result, $messageType);
        $this->showToastAndClear($message);
        $this->clearForm();

    }

    public function clearForm(): void
    {
        $this->isupdate = false;
        $this->form->reset();
        $this->resetAllProvince();
        $this->cleanFormValues();
        $this->form->setUp();
        $this->dispatch('showOptionsForms', show: false);
    }

    public function openTypes(): void
    {
        $this->dispatch('showTypesModal');
    }

    #[On('reloadInsuraceType')]
    public function reloadInsuraceType(): void
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

    #[On('dataPrestador')]
    public function InfoInsurance($insuranceId): void
    {
        $data = $this->form->infoPrestador($insuranceId);

        if ($data->city) {
            $this->setProvinceCity($data->city->province->id, $data->city->id);
            $this->setnameProvinceCity(
                $data->city->province->province_name->value,
                $data->city->city_name
            );
        } else {
            $this->resetAllProvince();
        }

        $this->isdisabled = 'disabled';
        $this->dispatch('clear-errors');
        $this->dispatch('showOptionsForms', show: true);
    }

    public function obrasocialHandleMenuAction(string $nameoption): void
    {
        $id = $this->form->dataobrasocial->insurance_id ?? 0;
        $this->handleAction(
            $nameoption,
            [
                'id' => $id,
                'pdfClass' => 'InsurancePdf',
                'route' => 're_prestador',
                'model' => 'Insurance',
            ]
        );
    }

    private function setIdPronvinceCity(): void
    {
        $this->form->dataobrasocial->province_id = $this->getProvinceId() === 0 ? null : $this->getProvinceId();
        $this->form->dataobrasocial->city_id = $this->getCityId() === 0 ? null : $this->getCityId();
    }
}
