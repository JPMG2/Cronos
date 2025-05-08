<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\DbTraits\TableFilter;
use App\Traits\RecordActivity;
use Database\Factories\MedicalFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;

final class Medical extends Model
{
    /** @use HasFactory<MedicalFactory> */
    use HasFactory, RecordActivity, TableFilter;

    public static string $startFilterBay = 'medical_name';

    protected $fillable = [
        'state_id',
        'credential_id',
        'specialty_id',
        'degree_id',
        'medical_name',
        'medical_lastname',
        'medical_address',
        'medical_phone',
        'medical_email',
        'medical_dni',
    ];

    public static function getFilterableAttributes(): array
    {
        return [
            'medical_name' => 'Nombre',
            'medical_lastname' => 'Apellido',
            'credential_id' => 'Matricula',
            'specialty_id' => 'Espacialidad',
            'state_id' => 'Estatus',
        ];
    }

    public static function countMedicals(): int
    {
        return self::count();
    }

    public function mainName(): string
    {
        return $this->medical_name;
    }

    public function setCredentialIdAttribute($value): void
    {
        $this->attributes['credential_id'] = $value ?: null;
    }

    public function setSpecialtyIdAttribute($value): void
    {
        $this->attributes['specialty_id'] = $value ?: null;
    }

    public function setDegreeIdAttribute($value): void
    {
        $this->attributes['degree_id'] = $value ?: null;
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class);
    }

    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function scopeListMedicals(Builder $query, ?string $stringsearch = null, ?string $relashion = null): Builder
    {
        $with = [
            'specialty:id,specialty_name',
            'degree:id,degree_name',
            'state:id,state_name',
            'credentials' => fn ($query) => $query->select('credentials.id', 'credential_name', 'credential_code', 'credential_number'),
        ];

        if ($relashion && method_exists($this, $relashion)) {
            $relationName = $this->getRelashionName($relashion);

            return $this->{$relashion}($query, $relationName, $stringsearch, $with);
        }

        return $query->with($with);
    }

    public function getRelashionName(string $relashionvalue): string
    {
        return Arr::get([
            'state_id' => 'state',
            'credential_id' => 'credentials',
            'specialty_id' => 'specialty',
            'degree_id' => 'degree',
        ], $relashionvalue, '');
    }

    public function getFirstCredentialNumberAttribute(): ?string
    {
        return $this->credentials->first()?->pivot->credential_number;
    }

    public function credentials(): BelongsToMany
    {
        return $this->belongsToMany(Credential::class)
            ->withPivot('credential_number');
    }

    protected function casts(): array
    {
        return [
            'state_id' => 'integer',
            'credential_id' => 'integer',
            'specialty_id' => 'integer',
            'degree_id' => 'integer',
        ];
    }

    protected function medicalName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(trim($value)))
        );
    }

    protected function medicalLastname(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(trim($value)))
        );
    }

    protected function medicalAddress(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(trim($value)))
        );
    }

    protected function medicalPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value)
        );
    }

    protected function medicalEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value))
        );
    }

    protected function medicalDni(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value)
        );
    }
}
