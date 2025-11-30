<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Classes\Services\QueryConvenio\PrestadorListService;
use App\Livewire\Forms\Convenio\ListPrestadorForm;
use App\Models\Insurance;
use App\Traits\TableSorting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

final class ListPrestador extends Component
{
    use TableSorting;
    use WithPagination;

    public $show = false;

    public ListPrestadorForm $form;

    public array $columnFilter = [
        'insurance_name' => '',
        'insurance_acronym' => '',
        'insuratype_name' => '',
        'insurance_code' => '',
        'state_name' => '',
    ];

    public function mount($show): void
    {
        $this->show = $show;

    }

    public function render(): Factory|View
    {
        return view(
            'livewire.convenio.list-prestador',
            [
                'listPestador' => $this->getPatientService()->listSearch($this->columnFilter)->paginate(15),
            ],
        );
    }

    #[On('showModalInsurance')]
    public function updateShow($show): void
    {
        $this->reset('columnFilter');
        $this->show = $show;
    }

    public function prestadorData($idPrestador): void
    {
        $this->dispatch('dataPrestador', $idPrestador);
        $this->show = false;
    }

    #[Computed]
    private function getPatientService(): PrestadorListService
    {
        return new PrestadorListService(new Insurance(), $this->sortDirection, $this->sortField);
    }
}
