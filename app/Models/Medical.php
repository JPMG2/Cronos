<?php

namespace App\Models;

use Database\Factories\MedicalFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
