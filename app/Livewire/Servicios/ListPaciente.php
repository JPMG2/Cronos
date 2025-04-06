<?php

declare(strict_types=1);

namespace App\Livewire\Servicios;

use App\Models\Person;
use App\Traits\TableSorting;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

final class ListPaciente extends Component
{
    use TableSorting,WithPagination;

    public $show = false;

    public function render()
    {
        $queryIncial = $this->patientlistList();

        $query = $this->makeQueryByColumn($queryIncial)->orderBy('num_document');

        return view('livewire.servicios.list-paciente', [
            'listPatients' => $query->paginate(10),
        ]);
    }

    #[Computed]
    public function patientlistList()
    {
        return Person::listPatients();
    }

    public function mount($show)
    {
        $this->show = $show;

    }

    #[On('showModalPatient')]
    public function updateShow($show)
    {
        $this->show = $show;
        $this->inicializteTableSorting('Person');
    }

    public function patientId($patientId)
    {
        $this->dispatch('dataPatient', $patientId);
        $this->show = false;
    }
}
