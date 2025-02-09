<?php

namespace App\Models;

use Database\Factories\MedicalFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medical extends Model
{
    /** @use HasFactory<MedicalFactory> */
    use HasFactory;

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
            set: fn ($value) => ucwords(strtolower(trim($value))),

        );
    }

    protected function medicalLastname(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower(trim($value))),

        );
    }

    protected function medicalAddress(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => ucwords(strtolower(trim($value))),
        );
    }

    protected function medicalphone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }

    public function setCredentialIdAttribute($value)
    {
        $this->attributes['credential_id'] = $value ?: null;
    }

    public function setSpecialtyIdAttribute($value)
    {
        $this->attributes['specialty_id'] = $value ?: null;
    }

    public function setDegreeIdAttribute($value)
    {
        $this->attributes['degree_id'] = $value ?: null;
    }

    protected function medicalEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower(trim($value)),
        );
    }

    protected function medicalDni(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }

    public function credentials(): BelongsToMany
    {
        return $this->belongsToMany(Credential::class)
            ->withPivot('credential_number');
    }

    public static function countMedicals()
    {
        return self::count();
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

    public function scopeListMedicals(Builder $query): Builder
    {
        return $query->with('specialty', 'degree', 'credentials', 'state')
            ->orderBy('medical_name');
    }

    public function getFirstCredentialNumberAttribute(): ?string
    {
        return $this->credentials()->first()?->pivot->credential_number;
    }
}
