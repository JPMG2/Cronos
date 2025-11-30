<?php

declare(strict_types=1);

namespace App\Dto;

use Livewire\Wireable;

final class InsurancePlanCoverageDto implements Wireable
{
    public function __construct(
        public ?int $insurance_plan_id = null,
        public ?int $coverage_id = null,
        public ?string $coverable_type = null,
        public ?float $plan_price = null,
        public ?float $plan_coverage_percentage = null,
        public ?float $deductible_amount = null,
        public ?float $coinsurance_percentage = null,
        public ?float $max_amount_per_event = null,
        public ?int $annual_max_uses = null,
        public ?bool $requires_referral = null,
        public ?string $coverage_notes = null,
    ) {}

    public static function fromLivewire($value): self
    {
        return self::fromArray(is_array($value) ? $value : []);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            insurance_plan_id: isset($data['insurance_plan_id']) ? (int) $data['insurance_plan_id'] : null,
            coverage_id: isset($data['coverage_id']) ? (int) $data['coverage_id'] : null,
            coverable_type: $data['coverable_type'] ?? null,
            plan_price: isset($data['plan_price']) ? (float) $data['plan_price'] : null,
            plan_coverage_percentage: isset($data['plan_coverage_percentage']) ? (float) $data['plan_coverage_percentage'] : null,
            deductible_amount: isset($data['deductible_amount']) ? (float) $data['deductible_amount'] : null,
            coinsurance_percentage: isset($data['coinsurance_percentage']) ? (float) $data['coinsurance_percentage'] : null,
            max_amount_per_event: isset($data['max_amount_per_event']) ? (float) $data['max_amount_per_event'] : null,
            annual_max_uses: isset($data['annual_max_uses']) ? (int) $data['annual_max_uses'] : null,
            requires_referral: isset($data['requires_referral']) ? (bool) $data['requires_referral'] : null,
            coverage_notes: $data['coverage_notes'] ?? null,
        );
    }

    public function toLivewire(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'insurance_plan_id' => $this->insurance_plan_id,
            'coverage_id' => $this->coverage_id,
            'coverable_type' => $this->coverable_type,
            'plan_price' => $this->plan_price,
            'plan_coverage_percentage' => $this->plan_coverage_percentage,
            'deductible_amount' => $this->deductible_amount,
            'coinsurance_percentage' => $this->coinsurance_percentage,
            'max_amount_per_event' => $this->max_amount_per_event,
            'annual_max_uses' => $this->annual_max_uses,
            'requires_referral' => $this->requires_referral,
            'coverage_notes' => $this->coverage_notes,
        ];
    }
}
