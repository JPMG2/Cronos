<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\DbTraits\TableFilter;
use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

final class Insurance extends Model
{
    use HasFactory, RecordActivity, TableFilter;

    public static string $startFilterBay = 'insurance_name';

    protected $fillable = [
        'insurance_type_id',
        'state_id',
        'city_id',
        'insurance_name',
        'insurance_acronym',
        'insurance_code',
        'insurance_cuit',
        'insurance_address',
        'insurance_phone',
        'insurance_zipcode',
        'insurance_email',
        'insurance_web',
    ];

    public static function getFilterableAttributes(): array
    {
        return [
            'insurance_name' => 'Nombre',
            'insurance_acronym' => 'Siglas',
            'insurance_type_id' => 'Tipo',
            'insurance_cuit' => 'CUIT',
            'insurance_code' => 'Código',
            'state_id' => 'Estatus',

        ];
    }

    public static function countInsurance(): ?int
    {
        return self::count();
    }

    public function mainName(): string
    {
        return $this->insurance_name;
    }

    public function insuranceType()
    {
        return $this->belongsTo(InsuranceType::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function scopeListInsurances(Builder $query, $stringsearch = null, $relashion = null): Builder
    {
        if (! is_null($relashion)) {
            $relationName = $this->getRelashionName($relashion);
            if (method_exists($this, $relashion)) {
                return $this->{$relashion}($query, $relationName, $stringsearch, ['insuranceType', 'state', 'city.province']);
            }
        }

        return $query->with(['insuranceType', 'state', 'city.province']);
    }

    public function getRelashionName(string $relashionvalue): string
    {
        $relashionarray = [
            'state_id' => 'state',
            'insurance_type_id' => 'insuranceType'];

        return Arr::get($relashionarray, $relashionvalue);

    }

    public function setCityIdAttribute($value)
    {

        if ((int) $value === 0) {
            $value = null;
        }

        $this->attributes['city_id'] = $value;
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function showData(int $id, string $relashion)
    {

        return $this->$relashion($id);
    }

    public function showInsuraceRelashion(int $id)
    {
        return self::with(['insuranceType', 'state', 'city.province'])->findOrFail($id);
    }

    protected function casts(): array
    {
        return [
            'insurance_type_id' => 'integer',
            'state_id' => 'integer',
            'city_id' => 'integer',
        ];
    }

    protected function insuranceName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function insuranceAcronym(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function insuranceCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function insuranceCuit(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function insuranceAddress(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function insurancePhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function insuranceZipcode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function insuranceEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }

    protected function insuranceWeb(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );

    }
}
