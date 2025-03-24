<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\PatientFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Patient extends Model
{
    /** @use HasFactory<PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'document_id', 'city_id', 'gender_id',
        'occupation_id', 'marital_status_id', 'nationality_id',
        'num_document', 'patient_name', 'patient_lastname',
        'patient_datebirth', 'patient_phone', 'patient_email',
        'patient_address', 'patient_photo'];

    public function setCityIdAttribute($value)
    {
        $this->attributes['city_id'] = $value ?: null;
    }

    public function setOccupationIdAttribute($value)
    {
        $this->attributes['occupation_id'] = $value ?: null;
    }

    public function setMaritalStatusIdAttribute($value)
    {
        $this->attributes['marital_status_id'] = $value ?: null;
    }

    public function setNationalityIdAttribute($value)
    {
        $this->attributes['nationality_id'] = $value ?: null;
    }

    protected function casts(): array
    {
        return [
            'document_id' => 'integer',
            'city_id' => 'integer',
            'gender_id' => 'integer',
            'occupation_id' => 'integer',
            'marital_status_id' => 'integer',
            'nationality_id' => 'integer',
            'patient_datebirth' => 'date',
        ];
    }

    protected function patientName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(trim($value))),

        );
    }

    protected function patientLastname(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(trim($value))),

        );
    }

    protected function patientEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),

        );
    }

    protected function patientAddress(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => ucwords(mb_strtolower(trim($value))),
        );
    }
}
