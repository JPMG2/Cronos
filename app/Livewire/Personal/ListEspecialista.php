<?php

namespace App\Livewire\Personal;

use App\Models\Medical;
use App\Traits\TableSorting;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListEspecialista extends Component
{
    use TableSorting, WithPagination;

    public $show = false;

    public function mount($show)
    {
        $this->show = $show;

    }

    public function render()
    {
        $queryIncial = Medical::listMedicals();

        $query = $this->makeQueryByColumn($queryIncial)->orderBy('medical_name');

        if (! empty($this->sortField)) {
            $this->nameRelashion = 'listMedicals';
            $query = $this->makeQueryBySearch($this->sortField, $queryIncial);
        }

        return view('livewire.personal.list-especialista', [
            'listMedical' => $query->paginate(10),
            'listFilterValues' => Medical::getFilterableAttributes(),
        ]);
    }

    #[On('showModalEspecialist')]
    public function updateShow($show)
    {
        $this->show = $show;
        $this->inicializteTableSorting('Medical');

    }

    public function dataMedic($medicId)
    {
        $this->dispatch('dataMedical', $medicId);
        $this->show = false;
    }
}
