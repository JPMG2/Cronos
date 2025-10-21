<?php

declare(strict_types=1);

namespace App\Livewire\Clinico;

use App\Classes\Services\QueryPerson\PatientListService;
use App\Livewire\Forms\Clinico\ListPatientForm;
use App\Models\Patient;
use App\Traits\TableSorting;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

final class ListPaciente extends Component
{
    use TableSorting;
    use WithPagination;

    public $show = false;

    public ListPatientForm $listForm;

    public array $columnFilter = [
        'num_document' => '',
        'person_name' => '',
        'person_lastname' => '',
        'gender_name' => '',
        'person_phone' => '',
        'person_email' => '',
    ];

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

        return view(
            'livewire.clinicos.list-paciente',
            [
                'listPatients' => $this->getPatientService()->listSearch($this->columnFilter)->paginate(15),
            ]
        );

    }

    public function mount($show): void
    {
        $this->show = $show;

    }

    #[On('showModalPatient')]
    public function updateShow($show): void
    {
        $this->show = $show;
        $this->reset('columnFilter');
        $this->setupTableSorting('Patient');
    }

    public function patientId($patientId): void
    {
        $this->dispatch('dataPatient', $patientId);
        $this->show = false;
    }

    #[Computed]
    private function getPatientService(): PatientListService
    {
        return new PatientListService(new Patient(), $this->sortDirection, $this->sortField);
    }
}
