<?php

declare(strict_types=1);

namespace App\Livewire\Registro;

use App\Classes\Registro\CompanyObj;
use App\Livewire\Forms\Registro\CompanyForm;
use App\Traits\ProvinceCity;
use App\Traits\UtilityForm;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReCompany extends Component
{
    use ProvinceCity;
    use UtilityForm;

    public CompanyForm $form;

    protected $commonQuerys;

    public function cleanForm(): void
    {
        $this->commonQuerys = app('commonquery');

        if ($this->commonQuerys::anyCompany()) {
            $this->loadCompany();

        } else {
            $this->form->resetForm();
            $this->resetAllProvince();
        }
    }

    public function loadCompany()
    {
        app()->call([$this->form, 'showCompany']);
        $this->setValuesPronvinceCity();
        $this->isupdate = true;
        $this->isdisabled = 'disabled';
    }

    public function setValuesPronvinceCity(): void
    {

        $this->setProvinceCity($this->form->getProvinceId(), $this->form->getCityId());

        $this->setnameProvinceCity($this->form->getProvinceName(), $this->form->getCityName());
    }

    public function mount(CompanyObj $companyObj)
    {

        if (! is_null($companyObj->show())) {
            $this->loadCompany();
        }
    }

    public function queryCompany(): void
    {
        $this->form->datacompany['city_id'] = max($this->getCityId(), 0);

        $this->form->datacompany['province_id'] = max($this->getProvinceId(), 0);

        $result = app()->call([$this->form, 'companyStoreUpdate']);

        $this->dispatch('show-toast', $result);

    }

    #[Title('- Empresa')]
    public function render()
    {

        $this->commonQuerys = app('commonquery');

        return view(
            'livewire.registro.re-company',
            [
                'listState' => $this->commonQuerys::stateQuery([1, 2]),
            ]
        );
    }
}
