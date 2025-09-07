<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Clinico;

use App\Classes\Services\ModelService;
use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class ServiceForm extends Form
{
    public array $dataservice = [
        'service_name' => '',
        'service_description' => '',
        'service_code' => '',
    ];

    public function serviceStore(): array
    {
        $validated = Validator::make(
            [
                'service_name' => ucwords(mb_strtolower(mb_trim($this->dataservice['service_name']))),
                'service_code' => mb_strtoupper(mb_trim($this->dataservice['service_code'])),
                'service_description' => ucfirst(mb_strtolower(mb_trim($this->dataservice['service_description']))),
            ],
            [
                'service_name' => AttributeValidator::uniqueIdNameLength(4, 'services', 'service_name', null),
                'service_code' => AttributeValidator::uniqueIdNameLength(4, 'services', 'service_code', null),
                'service_description' => AttributeValidator::stringValid(false, 4),
            ],
            [],
            [
                'service_name' => config('nicename.service'),
                'service_code' => config('nicename.codigo'),
                'service_description' => config('nicename.description'), ]
        )->validate();

        $services = $this->iniService();

        return NotifyQuerys::msgCreate($services->store($validated));
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
