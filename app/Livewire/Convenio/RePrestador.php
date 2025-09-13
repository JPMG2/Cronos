<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Dto\PrestadorDto;
use App\Livewire\Forms\Convenio\PrestadorForm;
use App\Models\Insurance;
use App\Models\InsuranceType;
use App\Traits\FormHandling;
use App\Traits\HandlesActionPolicy;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class RePrestador extends Component
{
    use FormHandling, HandlesActionPolicy;

    public PrestadorForm $form;

    private $commonQuerys;

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

    public function insuraceQuery(): void
    {
        $this->setIdPronvinceCity();
        $result = $this->isupdate ?
            app()->call([$this->form, 'insuranceUpdate']) :
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

    public function obrasocialHandleMenuAction(string $nameoption): void
    {
        $id = 0;
        $this->handleAction($nameoption, [
            'id' => $id,
            'pdfClass' => 'InsurancePdf',
            'route' => 're_obrasocial',
            'model' => 'Insurance',
        ]);
    }

    private function setIdPronvinceCity(): void
    {
        $this->form->dataobrasocial->province_id = $this->getProvinceId() === 0 ? null : $this->getProvinceId();
        $this->form->dataobrasocial->city_id = $this->getCityId() === 0 ? null : $this->getCityId();
    }
}
