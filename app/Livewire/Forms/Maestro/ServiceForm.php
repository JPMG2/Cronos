<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Maestro;

use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\QueryRepository;
use App\Enums\ServiceType;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

final class ServiceForm extends Form
{
    public array $dataservice = [
        'id' => null,
        'service_name' => '',
        'service_description' => '',
        'service_code' => '',
<<<<<<< HEAD
        'state_id' => 1,
        'category_id' => null,
        'categori_name' => '',
        'parent_service_id' => null,
        'parent_service_name' => '',
        'type' => 'final',
        'estimated_duration' => null,
        'requires_preparation' => false,
        'preparation_instructions' => '',
        'allows_subservices' => false,
        'display_order' => 0,
=======
        'state_id' => '',
        'category_id' => null,
        'categori_name' => '',
>>>>>>> 5e6df33 (Refactor `CommonQuerys` to `CommonQueries` across the codebase for improved naming consistency, update `CompanyWatcher`.)
    ];

    public function serviceStore(): Model
    {

        $validated = $this->validateServiceData();

        $ser = $this->iniService()->create($validated);

        dd($ser);
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
            'state_id' => config('nicename.status'),
            'category_id' => config('nicename.category'),
            'type' => config('nicename.type'),
            'parent_service_id' => config('nicename.pricipal'),
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
            'category_id' => $this->dataservice['category_id'] ?? null,
            'state_id' => $this->dataservice['state_id'] ?? null,
            'type' => $this->dataservice['type'] ?? 'final',
            'parent_service_id' => $this->dataservice['parent_service_id'] ?? null,
        ];
    }

    private function getValidationRules(?int $excludeId = null): array
    {
        return [
            'service_name' => AttributeValidator::uniqueIdNameLength(4, 'services', 'service_name', $excludeId),
            'service_code' => AttributeValidator::uniqueIdNameLength(4, 'services', 'service_code', $excludeId),
            'service_description' => AttributeValidator::stringValid(false, 4),
            'category_id' => AttributeValidator::requireAndExists('categories', 'id', 'id', true),
            'state_id' => AttributeValidator::requireAndExists('states', 'id', 'id', true),
            'type' => ['nullable', new Enum(ServiceType::class)],
            'parent_service_id' => AttributeValidator::requireAndExists('services', 'id', 'id', null),
        ];
    }

    private function iniService(): QueryRepository
    {
        return new QueryRepository(new Service());
    }
}
