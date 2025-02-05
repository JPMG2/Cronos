<?php

namespace App\Livewire\Registro;

use App\Classes\Utilities\CommonQuerys;
use Livewire\Attributes\On;
use Livewire\Component;

class ListBranch extends Component
{
    public $show = false;

    public $listCompanyBranch;

    public function mount($show)
    {
        $this->show = $show;

    }

    public function render(CommonQuerys $commonQuerys)
    {
        return view('livewire.registro.list-branch', [
            $this->listCompanyBranch = $commonQuerys::companyBranchQuery([1], ['1', '2']),
        ]);
    }

    #[On('showModal')]
    public function updateShow($show)
    {
        $this->show = $show;
    }

    public function dataBranch($branchId)
    {
        $this->dispatch('dataBranch', $branchId);
        $this->show = false;
    }
}
