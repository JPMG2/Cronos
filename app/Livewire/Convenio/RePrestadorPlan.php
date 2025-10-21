<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Classes\Services\QueryConvenio\PlanesPrestadorListService;
use App\Livewire\Forms\Convenio\ListPrestadorPlan;
use App\Models\InsurancePlan;
use App\Traits\TableSorting;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

final class RePrestadorPlan extends Component
{
    use TableSorting;
    use WithPagination;

    public ListPrestadorPlan $form;

    public array $columnFilter = [
        'insurance_plan_code' => '',
        'insurance_plan_name' => '',
        'state_name' => '',
        'insurance_name' => '',
    ];

    #[Title(' - Planes')]
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(
            'livewire.convenio.re-prestador-plan',
            [
                'listPlanesPrestador' => $this->getPlanesPrestador()->listSearch($this->columnFilter)->paginate(15),
            ]
        );
    }

    public function openModalPrestadorPlan(?int $id = null): void
    {
        $this->dispatch('showModalPrestadorPlan', $id);
    }

    #[On('prestadorRefresh')]
    public function refreshTable(): void
    {
        $this->resetPage();
    }

    #[Computed]
    private function getPlanesPrestador(): PlanesPrestadorListService
    {
        return new PlanesPrestadorListService(new InsurancePlan(), $this->sortDirection, $this->sortField);
    }
}
