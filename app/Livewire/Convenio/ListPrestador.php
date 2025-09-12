<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Models\Insurance;
use App\Traits\TableSorting;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

final class ListPrestador extends Component
{
    use TableSorting, WithPagination;

    public $show = false;

    public function mount($show)
    {
        $this->show = $show;

    }

    public function render()
    {
        $queryIncial = Insurance::listInsurances();

        $query = $this->makeQueryByColumn($queryIncial)->orderBy('insurance_name');

        if (! empty($this->sortField)) {
            $this->nameRelashion = 'listInsurances';
            $query = $this->makeQueryBySearch($this->sortField, $queryIncial);
        }

        return view('livewire.convenio.list-prestador', [
            'listInsurances' => $query->paginate(10),
        ]);
    }

    #[On('showModalInsurance')]
    public function updateShow($show)
    {
        $this->show = $show;
        $this->initializeTableSorting('Insurance');
    }

    public function dataInsurance($InsuranceId)
    {
        $this->dispatch('dataInsurance', $InsuranceId);
        $this->show = false;
    }
}
