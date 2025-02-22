<?php

namespace App\Livewire\Registro;

use App\Livewire\Forms\Registro\BranchForm;
use App\Models\Branch;
use App\Traits\HandlesActionPolicy;
use App\Traits\ProvinceCity;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReBranch extends Component
{
    use HandlesActionPolicy, ProvinceCity, UtilityForm;

    public BranchForm $form;

    protected $commonQuerys;

    #[Title(' - Sucursal')]
    public function render()
    {

        $this->commonQuerys = app('commonquery');

        return view('livewire.registro.re-branch', [
            'listCompanies' => $this->commonQuerys::companyQuery([1]),
            'listState' => $this->commonQuerys::stateQuery([1, 2]),

        ]);
    }

    public function queryBranch()
    {
        $this->setIdPronvinceCity();

        if (! $this->isupdate) {
            $result = app()->call([$this->form, 'branchStore']);

        } else {
            $result = app()->call([$this->form, 'branchUpdate']);
        }
        $this->endForm($result);
    }

    public function endForm($result)
    {
        $this->dispatch('show-toast', $result);

        $this->dispatch('clearColorOpcionMenu');

        $this->clearForm();
    }

    public function setIdPronvinceCity()
    {

        $this->form->databranch['province_id'] = $this->getProvinceId();
        $this->form->databranch['city_id'] = $this->getCityId();
    }

    public function clearForm()
    {
        $this->form->reset();
        $this->resetAllProvince();
        $this->cleanFormValues();
        $this->editActivate();
        $this->dispatch('showOptionsForms', show: false);
    }

    public function getBranchsProperty()
    {
        return Branch::countBranch();
    }

    // events that is fire from user options bar to Show branch
    public function branchShow()
    {
        $this->dispatch('showOptionForm', 'showModalBranch', true);
    }

    // events that is fire from user options bar to Edit branch
    public function branchEdit()
    {
        $this->editActivate();
    }

    // events that is fire from user options bar to Reload form
    public function branchNew(): void
    {
        $this->dispatch('new-form', 're_sucursal');
    }

    public function branchPrint(): void
    {
        $idBranch = $this->form->databranch['id'];

        $className = 'BranchPdf';

        $this->dispatch('printByID', ['idmodel' => $idBranch, 'className' => $className]);

    }

    // events that is fire from user options bar to show History branch
    public function branchHistory()
    {

        $this->dispatch('showModalHistory', ['model' => 'Branch', 'id' => $this->form->databranch['id']]);
    }

    #[On('dataBranch')]
    public function loadBranch($branchId)
    {
        app()->call([$this->form, 'infoBranc'], ['branchId' => $branchId]);

        $this->IdandNames(
            $this->form->getProvinceId(), $this->form->getCityId(),
            $this->form->getProvinceName(), $this->form->getCityName());

        $this->isdisabled = 'disabled';

        $this->dispatch('showOptionsForms', show: true);
    }
}
