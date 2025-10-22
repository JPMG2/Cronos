<?php

declare(strict_types=1);

namespace App\Livewire\Maestro;

use App\Classes\Services\QueryMaestro\MedicListService;
use App\Livewire\Forms\Maestro\ListEspecialistaForm;
use App\Models\Medical;
use App\Traits\TableSorting;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

final class ListEspecialista extends Component
{
    use TableSorting;
    use WithPagination;

    public ListEspecialistaForm $listForm;

    public $show = false;

    public array $columnFilter = [
        'person_name' => '',
        'person_lastname' => '',
        'num_document' => '',
        'specialty_name' => '',
        'credential_number' => '',
    ];

    public function mount($show): void
    {
        $this->show = $show;
    }

    public function render()
    {
        return view(
            'livewire.maestro.list-especialista',
            [
                'listMedical' => $this->getMedicService()->listSearch($this->columnFilter)->paginate(15),
            ]
        );
    }

    #[On('showModalMedical')]
    public function updateShow($show): void
    {
        $this->show = $show;
        $this->reset('columnFilter');
        $this->setupTableSorting('Medical');
    }

    public function dataMedic($medicId): void
    {
        $this->dispatch('dataMedical', $medicId);
        $this->show = false;
    }

    #[Computed]
    private function getMedicService(): MedicListService
    {
        return new MedicListService(new Medical(), $this->sortDirection, $this->sortField);
    }
}
