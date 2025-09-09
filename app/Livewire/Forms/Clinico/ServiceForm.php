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
        $validated = $this->validateServiceData();

        $services = $this->iniService();

        return NotifyQuerys::msgCreate($services->store($validated));
    }

    public function serviceUpdate(): array
    {
        $validated = $this->validateServiceData($this->dataservice['id']);

        $services = $this->iniService();

        return NotifyQuerys::msgUpadte($services->update($validated, $this->dataservice['id']));
    }

    public function loadDataServices($services): void
    {
        $this->dataservice = $services->toArray();
    }

    protected function getValidationAttributes(): array
    {
        return [
            'service_name' => config('nicename.service'),
            'service_code' => config('nicename.codigo'),
            'service_description' => config('nicename.description'),
        ];
    }

    private function validateServiceData(?int $excludeId = null): array
    {
        return Validator::make(
            $this->transformServiceData(),
            $this->getValidationRules($excludeId),
            [],
            $this->getValidationAttributes()
        )->validate();
    }

    private function transformServiceData(): array
    {
        return [
            'service_name' => ucwords(mb_strtolower(mb_trim((string) ($this->dataservice['service_name'] ?? '')))),
            'service_code' => mb_strtoupper(mb_trim((string) ($this->dataservice['service_code'] ?? ''))),
            'service_description' => ucfirst(mb_strtolower(mb_trim((string) ($this->dataservice['service_description'] ?? '')))),
        ];
    }

    private function getValidationRules(?int $excludeId = null): array
    {
        return [
            'service_name' => AttributeValidator::uniqueIdNameLength(4, 'services', 'service_name', $excludeId),
            'service_code' => AttributeValidator::uniqueIdNameLength(4, 'services', 'service_code', $excludeId),
            'service_description' => AttributeValidator::stringValid(false, 4),
        ];
    }

    private function iniService(): ModelService
    {
        return new ModelService(new Service);
    }
}
