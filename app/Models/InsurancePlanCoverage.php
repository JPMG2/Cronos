<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\RecordActivity;
use Database\Factories\InsurancePlanCoverageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $insurance_plan_id
 * @property int $coverable_id
 * @property string $coverable_type
 * @property ?float $plan_price
 * @property ?float $plan_coverage_percentage
 * @property ?float $deductible_amount
 * @property ?float $coinsurance_percentage
 * @property ?float $max_amount_per_event
 * @property ?int $annual_max_uses
 * @property ?bool $requires_referral
 * @property ?string $coverage_notes
 * @property-read InsurancePlan $insurancePlan
 */
final class InsurancePlanCoverage extends Model
{
    /**
     * @use HasFactory<InsurancePlanCoverageFactory>
     */
    use HasFactory;

    use RecordActivity;
    use SoftDeletes;

    protected $fillable = ['insurance_plan_id', 'coverage_id', 'coverable_type', 'plan_price', 'plan_coverage_percentage',
        'deductible_amount', 'coinsurance_percentage', 'max_amount_per_event', 'annual_max_uses', 'requires_referral',
        'coverage_notes',
    ];

    public function insurancePlan(): BelongsTo
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    protected function casts(): array
    {
        return [
            'plan_price' => 'decimal:2',
            'plan_coverage_percentage' => 'decimal:2',
            'deductible_amount' => 'decimal:2',
            'coinsurance_percentage' => 'decimal:2',
            'max_amount_per_event' => 'decimal:2',
            'annual_max_uses' => 'integer',
            'requires_referral' => 'bool',
        ];
    }
}
