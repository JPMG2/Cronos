<?php

declare(strict_types=1);

namespace App\Livewire\Registro;

use App\Classes\Utilities\CommonQueries;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

final class ListBranch extends Component
{
    use WithPagination;

    public $show = false;

    public $listCompanyBranch;

    public function mount($show): void
    {
        $this->show = $show;

    }

<<<<<<< HEAD
    public function render(CommonQueries $commonQuerys): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
=======
    public function render(CommonQueries $commonQuerys)
>>>>>>> 5e6df33 (Refactor `CommonQuerys` to `CommonQueries` across the codebase for improved naming consistency, update `CompanyWatcher`.)
    {
        return view(
            'livewire.registro.list-branch',
            [
                $this->listCompanyBranch = $commonQuerys::companyBranchQuery([1], ['1', '2']),
            ]
        );
    }

    #[On('showModalBranch')]
    public function updateShow($show): void
    {
        $this->show = $show;
    }

    public function dataBranch($branchId): void
    {
        $this->dispatch('dataBranch', $branchId);
        $this->show = false;
    }
}
