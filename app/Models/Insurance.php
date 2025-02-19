<?php

namespace App\Models;

use App\Traits\DbTraits\TableFilter;
use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory, RecordActivity, TableFilter;

    public static string $startFilterBay = 'insurance_acronym';

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
            'insurance_code' => 'Código',
            'insurance_type_id' => 'Tipo',
            'state_id' => 'Estatus',

        ];
    }

    public static function countInsurance(): ?int
    {
        return self::count();
    }

    public function insuranceType()
    {
        return $this->belongsTo(InsuranceType::class);
    }

    public function scopeListInsurances(Builder $query): Builder
    {
        return $query;
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
            set: fn ($value) => strtoupper(strtolower(trim($value))),
        );
    }

    protected function insuranceAcronym(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper(strtolower(trim($value))),
        );
    }

    protected function insuranceCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper(strtolower(trim($value))),
        );
    }

    protected function insuranceCuit(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper(strtolower(trim($value))),
        );
    }

    protected function insuranceAddress(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => ucwords(strtolower(trim($value))),
        );
    }

    protected function insurancePhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper(strtolower(trim($value))),
        );
    }

    protected function insuranceZipcode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper(strtolower(trim($value))),
        );
    }

    protected function insuranceEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower(trim($value)),
        );
    }

    protected function insuranceWeb(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower(trim($value)),
        );
    }
}
