<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Maestro;

use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\QueryRepository;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class ServiceForm extends Form
{
    public array $dataservice = [
        'service_name' => '',
        'service_description' => '',
        'service_code' => '',
    ];

    public function serviceStore(): Model
    {
        $validated = $this->validateServiceData();

        return $this->iniService()->create($validated);
    }

    public function serviceUpdate(): Model
    {
        $validated = $this->validateServiceData($this->dataservice['id']);

        return $this->iniService()->update($this->dataservice['id'], $validated);
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

    private function iniService(): QueryRepository
    {
        return new QueryRepository(new Service());
    }
}
