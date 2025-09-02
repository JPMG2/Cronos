<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Clinico;

use App\Classes\Services\ModelService;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\Service;
use Livewire\Attributes\Rule;
use Livewire\Form;

final class ServiceForm extends Form
{
    #[Rule('required|string|max:255')]
    public string $service_name = '';

    #[Rule('required|string')]
    public string $service_description = '';

    #[Rule('required|string|max:50|unique:services,service_code')]
    public string $service_code = '';

    #[Rule('required|integer|exists:states,id')]
    public int $state_id = 0;

    public array $dataservice = [
        'service_name' => '',
        'service_description' => '',
        'service_code' => '',
        'state_id' => 0,
    ];

    public function serviceStore(): array
    {
        $this->validate();
        $services = $this->iniService();

        return NotifyQuerys::msgCreate($services->store($this->dataservice));
    }

    public function serviceUpdate($modelService): array
    {
        $this->rules()['service_code'] = 'required|string|max:50|unique:services,service_code,'.$modelService->id;
        $this->validate();

        $services = $this->iniService();

        return NotifyQuerys::msgUpadte($services->update($this->dataservice, $modelService->id));
    }

    protected function iniService(): ModelService
    {
        return new ModelService(new Service);
    }
}
