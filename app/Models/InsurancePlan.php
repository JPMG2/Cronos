<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Filterable;
use App\Traits\RecordActivity;
use Carbon\CarbonImmutable;
use Database\Factories\InsurancePlanFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class InsurancePlan extends Model implements Filterable
{
    /**
     * @use HasFactory<InsurancePlanFactory>
     */
    use HasFactory;

    use RecordActivity;

    protected $fillable = ['insurance_id', 'state_id', 'insurance_plan_name',
        'insurance_plan_code', 'insurance_start_date', 'insurance_end_date', 'insurance_plan_description',
        'authorisation', 'insurance_plan_condition'];

    public static function getDefaultFilterField(): string
    {
        return 'insurance_plan_code';
    }

    public static function getRelationModel(): array
    {
        return [
            'state:id,state_name',
            'insurance:id,insurance_name,insurance_code',
        ];
    }

    public function insurance(): BelongsTo
    {
        return $this->belongsTo(Insurance::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    #[Scope]
    protected function planAndStatus(Builder $query, ?array $filters = null)
    {
        return $query->when($filters['status'] ?? null, function ($query, $statusIds) {
            $query->whereIn('state_id', $statusIds);
        })->with(self::getRelationModel());
    }

    #[Scope]
    protected function planId(Builder $query, ?int $planId = null)
    {
        return $query->when($planId, fn ($q) => $q->where('id', $planId))->with(self::getRelationModel());
    }

    protected function casts(): array
    {
        return [
            'insurance_id' => 'integer',
            'state_id' => 'string',
            'authorisation' => 'bool',
            'insurance_start_date' => 'date',
            'insurance_end_date' => 'date',
        ];
    }

    protected function insurancePlanCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_trim($value)),
        );
    }

    protected function insurancePlanName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function insuranceEndDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value): string => CarbonImmutable::parse($value)->format('d-m-Y'),
            set: fn ($value): ?string => is_null($value) ? null : CarbonImmutable::parse($value)->format('Y-m-d'),
        );
    }

    protected function insuranceStartDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value): string => CarbonImmutable::parse($value)->format('d-m-Y'),
            set: fn ($value): string => CarbonImmutable::parse($value)->format('Y-m-d'),
        );
    }

    protected function insurancePlanDescription(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? '' : $value,
            set: fn ($value): string => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }

    protected function insurancePlanCondition(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? '' : $value,
            set: fn ($value): string => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }
}
