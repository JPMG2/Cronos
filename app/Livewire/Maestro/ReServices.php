<?php

declare(strict_types=1);

namespace App\Livewire\Maestro;

use App\Classes\Utilities\CommonQueries;
use App\Livewire\Forms\Maestro\ServiceForm;
use App\Models\Category;
use App\Models\Service;
use App\Traits\UtilityForm;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReServices extends Component
{
    use UtilityForm;

    public ServiceForm $form;

    public $openservice = false;

    public $listCategory = [];

    public int $currentStep = 1;

    public $parentServiceId = null;

    #[Title(' - Servicios')]
    public function render()
    {
        return view('livewire.maestro.re-services');
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
        $this->form->reset();
        $this->isupdate = false;
        $this->currentStep = 1;
        $this->parentServiceId = null;
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

    public function infoService(Service $service): void
    {
        $this->form->loadDataServices($service);
        $this->openservice = true;
        $this->isupdate = true;
        $this->currentStep = 2; // Auto-show both panels when editing
    }

    #[Computed]
    public function services(): Collection
    {
        return Service::query()->listServices([1, 2])->get();
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

    public function updatedFormDataserviceCategoriName($value)
    {
        if (str()->length($value) >= 2) {

            $this->listCategory = $this->categoryQuery($value);

        } else {
            $this->listCategory = [];
        }
    }

    public function categoryQuery(string $value)
    {
        return Category::list([1], $value)
            ->get();
    }

    protected function validateCurrentStep(): void
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'form.dataservice.service_code' => 'required|min:4',
                'form.dataservice.service_name' => 'required|min:4',
            ]);
        }
    }
}
