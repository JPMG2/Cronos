<?php

namespace App\Livewire\Gestion;

use App\Models\Insurance;
use App\Traits\TableSorting;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListObraSocial extends Component
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

        return view('livewire.gestion.list-obra-social', [
            'listInsurances' => $query->paginate(10),
        ]);
    }

    #[On('showModalInsurance')]
    public function updateShow($show)
    {
        $this->show = $show;
        $this->inicializteTableSorting('Insurance');
    }

    public function dataInsurance($InsuranceId)
    {
        $this->dispatch('dataInsurance', $InsuranceId);
        $this->show = false;
    }
}
