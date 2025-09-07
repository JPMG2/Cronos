<?php

declare(strict_types=1);

namespace App\Livewire\Clinico;

use App\Livewire\Forms\Clinico\ServiceForm;
use App\Models\Service;
use App\Traits\UtilityForm;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReServices extends Component
{
    use UtilityForm;

    public ServiceForm $form;

    public $openservice = false;

    public $serviceobject;

    protected $commonQuerys;

    #[Title(' - Servicios')]
    public function render()
    {
        return view('livewire.clinicos.re-services');
    }

    public function queryService(): void
    {
        if (! ($this->isupdate)) {
            $result = app()->call([$this->form, 'serviceStore']);
        } else {
            $result = app()->call([$this->form, 'serviceUpdate'], ['modelService' => $this->serviceobject]);
        }

        $this->dispatch('show-toast', $result);
        $this->isupdate = false;
        $this->clearForm();
    }

    public function clearForm(): void
    {
        $this->form->reset();
        $this->openservice = false;
    }

    public function editService(Service $service): void
    {
        $this->form->dataservice['service_name'] = $service->service_name;
        $this->form->dataservice['service_description'] = $service->service_description;
        $this->form->dataservice['service_code'] = $service->service_code;
        $this->form->dataservice['state_id'] = $service->state_id;
        $this->openservice = true;
        $this->isupdate = true;
        $this->serviceobject = $service;
    }

    public function getServicesProperty()
    {
        return Service::query()->orderBy('service_name')->get();
    }
}
