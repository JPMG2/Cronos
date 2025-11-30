<?php

declare(strict_types=1);

namespace App\Dto;

use Livewire\Wireable;
use Money\Money;

final class ServicesDto implements Wireable
{
    public function __construct(
        public ?int $id = null,
        public ?string $service_name = '',
        public ?string $service_description = '',
        public ?string $service_code = '',
        public ?int $state_id = 1,
        public ?int $category_id = null,
        public ?string $categori_name = '',
        public ?int $parent_service_id = null,
        public ?string $parent_service_name = '',
        public string $type = 'final',
        public ?int $estimated_duration = null,
        public ?int $display_order = null,
        public ?string $estimated_price = null,
        public bool $requires_preparation = false,
        public ?string $preparation_instructions = '',
        public int|float|string|null $base_price = null,
    ) {}

    public static function fromLivewire($value): self
    {
        return self::fromArray(is_array($value) ? $value : []);
    }

    public static function fromArray(array $data): self
    {
        $basePrice = $data['base_price'] ?? null;

        if ($basePrice instanceof Money) {
            $basePrice = moneyToInput($basePrice);
        }

        return new self(
            id: isset($data['id']) ? (int) $data['id'] : null,
            service_name: $data['service_name'] ?? '',
            service_description: $data['service_description'] ?? '',
            service_code: $data['service_code'] ?? '',
            state_id: isset($data['state_id']) ? (int) $data['state_id'] : 1,
            category_id: isset($data['category_id']) ? (int) $data['category_id'] : null,
            categori_name: $data['categori_name'] ?? '',
            parent_service_id: isset($data['parent_service_id']) ? (int) $data['parent_service_id'] : null,
            parent_service_name: $data['parent_service_name'] ?? '',
            type: $data['type'] ?? 'final',
            estimated_duration: castToInt($data['estimated_duration'] ?? null),
            display_order : castToInt($data['display_order'] ?? null),
            requires_preparation: isset($data['requires_preparation']) && (bool) $data['requires_preparation'],
            preparation_instructions: $data['preparation_instructions'] ?? '',
            base_price: $basePrice,
        );
    }

    public function toLivewire(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'service_name' => $this->service_name,
            'service_description' => $this->service_description,
            'service_code' => $this->service_code,
            'state_id' => $this->state_id,
            'category_id' => $this->category_id,
            'categori_name' => $this->categori_name,
            'parent_service_id' => $this->parent_service_id,
            'parent_service_name' => $this->parent_service_name,
            'type' => $this->type,
            'estimated_duration' => $this->estimated_duration,
            'display_order' => $this->display_order,
            'requires_preparation' => $this->requires_preparation,
            'preparation_instructions' => $this->preparation_instructions,
            'base_price' => $this->base_price instanceof Money
                ? moneyToFloat($this->base_price)
                : $this->base_price,
        ];
    }
}
