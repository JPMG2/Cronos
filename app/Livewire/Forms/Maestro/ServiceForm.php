<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Maestro;

use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\QueryRepository;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Form;

final class ServiceForm extends Form
{
    public array $dataservice = [
        'id' => null,
        'service_name' => '',
        'service_description' => '',
        'service_code' => '',
        'state_id' => 1,
        'category_id' => null,
        'categori_name' => '',
        'parent_service_id' => null,
        'parent_service_name' => '',
        'type' => 'final',
        'estimated_duration' => null,
        'requires_preparation' => false,
        'preparation_instructions' => '',
        'base_price' => 0,
        'allows_subservices' => false,
        'display_order' => 0,
    ];

    private ?QueryRepository $serviceRepo = null;

    public function serviceStore(): Service
    {

        $validated = $this->validateServiceData();

        return $this->repo()->create($validated);

    }

    public function serviceUpdate(): Model
    {
        $validated = $this->validateServiceData($this->dataservice['id']);

        return $this->repo()->update($this->dataservice['id'], $validated);
    }

    public function loadDataServices(int $idService): void
    {
        $service = Service::with(Service::getRelationModel())->findOrFail($idService);
        $this->dataservice = prepareData($service->toArray(), array_keys($this->dataservice));
        $this->dataservice['categori_name'] = $service->category->categori_name;
    }

    public function validateBasicInfo(): void
    {
        $data = [
            'service_name' => ucwords(mb_strtolower(mb_trim((string) ($this->dataservice['service_name'] ?? '')))),
            'service_code' => mb_strtoupper(mb_trim((string) ($this->dataservice['service_code'] ?? ''))),
            'category_id' => $this->dataservice['category_id'] ?? null,
        ];

        $rules = [
            'service_name' => 'required|min:4',
            'service_code' => 'required|min:4',
            'category_id' => 'required|exists:categories,id',
        ];

        $attributes = [
            'service_name' => config('nicename.service'),
            'service_code' => config('nicename.codigo'),
            'category_id' => config('nicename.category'),
        ];

        Validator::make($data, $rules, [], $attributes)->validate();
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
            'requires_preparation' => config('nicename.preparacion'),
            'preparation_instructions' => config('nicename.instrucciones'),
            'base_price' => config('nicename.price'),
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
            'requires_preparation' => $this->dataservice['requires_preparation'] ?? false,
            'preparation_instructions' => ucfirst(mb_strtolower(mb_trim((string) ($this->dataservice['preparation_instructions'] ?? '')))),
            'base_price' => $this->dataservice['base_price'] ?? 0,
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
            'type' => AttributeValidator::servicesType($excludeId),
            'parent_service_id' => AttributeValidator::requireAndExists('services', 'id', 'id', null),
            'requires_preparation' => AttributeValidator::booleanValue(false),
            'preparation_instructions' => Rule::requiredIf(fn () => (bool) ($this->dataservice['requires_preparation'] ?? false)),
        ];
    }

    private function repo(): QueryRepository
    {
        return $this->serviceRepo ??= new QueryRepository(new Service());
    }
}
