<?php

declare(strict_types=1);

namespace App\Livewire\Registro;

use App\Livewire\Forms\Registro\BranchForm;
use App\Models\Branch;
use App\Traits\FormActionsTrait;
use App\Traits\HandlesActionPolicy;
use App\Traits\ProvinceCity;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReBranch extends Component
{
    use FormActionsTrait;
    use HandlesActionPolicy;
    use ProvinceCity;
    use UtilityForm;

    public BranchForm $form;

    private $commonQuerys;

    #[Title(' - Sucursal')]
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

        $this->commonQuerys = app('commonquery');

        return view(
            'livewire.registro.re-branch',
            [
                'listCompanies' => $this->commonQuerys::companyQuery([1]),
                'listState' => $this->commonQuerys::stateQuery([1, 2]),

            ],
        );
    }

    public function queryBranch(): void
    {
        $this->form->setIdPronvinceCity($this->getProvinceId(), $this->getCityId());

        $result = $this->isupdate ? app()->call($this->form->branchUpdate(...)) : app()->call($this->form->branchStore(...));
        $this->endForm($result);
    }

    public function endForm($result): void
    {
        $this->dispatch('show-toast', $result);

        $this->dispatch('clearColorOpcionMenu');

        $this->clearForm();
    }

    public function clearForm(): void
    {
        $this->form->reset();
        $this->resetAllProvince();
        $this->cleanFormValues();
        $this->editActivate();
        $this->dispatch('showOptionsForms', show: false);
    }

    #[\Livewire\Attributes\Computed]
    public function branchs()
    {
        return Branch::countBranch();
    }

    #[On('dataBranch')]
    public function loadBranch($branchId): void
    {
        $this->form->reset();
        app()->call($this->form->infoBranc(...), ['branchId' => $branchId]);

        $this->setLocactionNameID(
            $this->form->getProvinceId(),
            $this->form->getCityId(),
            $this->form->getProvinceName(),
            $this->form->getCityName(),
        );

        $this->isdisabled = 'disabled';

        $this->dispatch('showOptionsForms', show: true);
    }

    public function branchHandleMenuAction(string $nameoption): void
    {
        $id = $this->form->databranch['id'] ?? 0;
        $this->handleAction(
            $nameoption,
            [
                'id' => $id,
                'pdfClass' => 'BranchPdf',
                'route' => 're_sucursal',
                'model' => 'Branch',
            ],
        );
    }
}
