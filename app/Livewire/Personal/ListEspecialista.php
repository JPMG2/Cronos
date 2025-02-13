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
        $query = Medical::listMedicals();
        $query = $this->makeQuery($query);

        return view('livewire.personal.list-especialista', [
            'listMedical' => $query->paginate(10),
            'listFilterValues' => Medical::getFilterableAttributes(),
        ]);
    }

    #[On('showModalEspecialist')]
    public function updateShow($show)
    {
        $this->show = $show;
        $this->resetPage();
        $this->resetOrdersValues();
    }

    public function dataMedic($medicId)
    {
        $this->dispatch('dataMedical', $medicId);
        $this->show = false;
    }
}
