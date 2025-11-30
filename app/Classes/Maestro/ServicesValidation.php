<?php

declare(strict_types=1);

namespace App\Classes\Maestro;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

final class ServicesValidation
{
    public function validateServiceData(?int $excludeId, array $data): array
    {
        return Validator::make(
            $this->transformServiceData($data),
            $this->getValidationRules($excludeId),
            [],
            $this->getValidationAttributes(),
        )->validate();
    }

    private function transformServiceData(array $data): array
    {
        return [
            'service_name' => ucwords(mb_strtolower(mb_trim((string) ($data['service_name'] ?? '')))),
            'service_code' => mb_strtoupper(mb_trim((string) ($data['service_code'] ?? ''))),
            'service_description' => ucfirst(mb_strtolower(mb_trim((string) ($data['service_description'] ?? '')))),
            'category_id' => $data['category_id'] ?? null,
            'state_id' => $data['state_id'] ?? null,
            'type' => $data['type'] ?? 'final',
            'parent_service_id' => $data['parent_service_id'] ?? null,
            'estimated_duration' => $data['estimated_duration'] ?? null,
            'display_order' => $data['display_order'] ?? 0,
            'requires_preparation' => $data['requires_preparation'] ?? false,
            'preparation_instructions' => ucfirst(mb_strtolower(mb_trim((string) ($data['preparation_instructions'] ?? '')))),
            'base_price' => is_int($data['base_price'] ?? null) ? $data['base_price'] : moneyToCents($data['base_price'] ?? null),
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
            'base_price' => AttributeValidator::moneyInteger(false),
            'estimated_duration' => AttributeValidator::numericInteger(false),
            'display_order' => AttributeValidator::numericInteger(false),
            'preparation_instructions' => AttributeValidator::stringValid(false, 4),
        ];
    }

    private function getValidationAttributes(): array
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
            'estimated_duration' => config('nicename.duration'),
            'display_order' => config('nicename.orden'),
            'base_price' => config('nicename.price'),
        ];
    }
}
