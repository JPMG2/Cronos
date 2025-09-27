<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Filterable;
use Database\Factories\InsurancePlanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class InsurancePlan extends Model implements Filterable
{
    /**
     * @use HasFactory<InsurancePlanFactory>
     */
    use HasFactory;

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
}
