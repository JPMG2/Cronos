<?php

declare(strict_types=1);

namespace App\Livewire\Maestro;

use App\Classes\Services\QueryMaestro\ServicioListService;
use App\Classes\Utilities\AlertModal;
use App\Classes\Utilities\CommonQueries;
use App\Classes\Utilities\NotifyQuerys;
use App\Livewire\Forms\Maestro\ServiceForm;
use App\Models\Category;
use App\Models\Service;
use App\Traits\HandleMenuAction;
use App\Traits\TableSorting;
use App\Traits\UtilityForm;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

final class ReServices extends Component
{
    use HandleMenuAction;
    use TableSorting;
    use UtilityForm;
    use WithPagination;

    public ServiceForm $form;

    public $openservice = false;

    public $listCategory = [];

    public int $currentStep = 1;

    public $parentServiceId = null;

    public array $columnFilter = [
        'service_code' => '',
        'service_name' => '',
        'state_name' => '',
        'categori_name' => '',
    ];

    #[Title(' - Servicios')]
    public function render()
    {
        return view('livewire.maestro.re-services',
            [
                'listServicios' => $this->services()->listSearch($this->columnFilter)->paginate(15),
            ]);
    }

    #[Computed]
    public function services(): ServicioListService
    {
        return new ServicioListService(new Service(), $this->sortDirection, $this->sortField);
    }

    public function queryService(): void
    {
        $result = $this->isupdate ?
            $this->form->serviceUpdate() :
            $this->form->serviceStore();
        $messageType = $this->isupdate ? 'msgUpdate' : 'msgCreate';
        $message = $this->showQueryMessage($result, $messageType);
        $this->showToastAndClear($message);
        $this->clearForm();
        $this->openservice = false;

    }

    public function clearForm(): void
    {

        $this->resetForm();
        $this->isupdate = false;
        $this->currentStep = 1;
        $this->parentServiceId = null;

    }

    public function resetForm(): void
    {
        $this->form->reset();
        $this->cleanFormValues();
    }

    public function nextStep(): void
    {
        $this->validateCurrentStep();
        $this->currentStep++;
    }

    public function previousStep(): void
    {
        $this->currentStep--;
    }

    public function infoService(int $idService): void
    {
        $this->form->loadDataServices($idService);
        $this->openservice = true;
        $this->isupdate = true;
        $this->currentStep = 2;
    }

    #[Computed]
    public function states(): Collection
    {
        return CommonQueries::stateQuery([1, 2]);
    }

    #[Computed]
    public function serviceGroup(): Collection
    {
        return Service::query()->groups()->active()->orderBy('level')->get();
    }

    public function updatedFormDataserviceCategoriName($value): void
    {
        $this->listCategory = str()->length($value) >= 2 ? $this->categoryQuery($value) : [];
    }

    public function deleteService(int $idService): void
    {
        $service = Service::find($idService);
        $this->messageWindow(
            $service,
            function ($service) {
                if (! empty($this->checkService($service)['message'])) {
                    return new AlertModal(
                        exception: 0,
                        type: 'error',
                        title: 'Error',
                        buttonName: '',
                        event: '',
                        message: $this->checkService($service)['message'],
                        idModel: 0
                    );
                }

                return new AlertModal(
                    exception: 1,
                    type: 'warning',
                    title: 'Advertencia',
                    buttonName: 'Borrar',
                    event: 'serviceRemove',
                    message: 'Realmente desea borrar el servicio ?',
                    idModel: $service->id
                );
            }
        );
    }

    #[On('serviceRemove')]
    public function remove(): void
    {
        NotifyQuerys::msgDestroy(Service::destroy($this->idRemove));
    }

    private function validateCurrentStep(): void
    {
        if ($this->currentStep === 1) {
            $this->validate(
                [
                    'form.dataservice.service_code' => 'required|min:4',
                    'form.dataservice.service_name' => 'required|min:4',
                ]
            );
        }
    }

    private function categoryQuery(string $value): Collection
    {
        return Category::list([1], $value)->get();
    }

    private function checkService($service): array
    {
        if ($service->childrenCount >= 1) {
            return [
                'message' => 'El servicio tiene sub-grupos, no puede ser eliminado',
            ];
        }

        return [];
    }
}
