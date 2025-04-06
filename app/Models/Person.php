<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\PersonFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Person extends Model
{
    /** @use HasFactory<PersonFactory> */
    use HasFactory;

    public static string $startFilterBay = 'num_document';

    protected $fillable = [
        'document_id', 'city_id', 'gender_id', 'marital_status_id', 'occupation_id',
        'nationality_id', 'num_document', 'person_name', 'person_lastname',
        'person_address', 'person_phone', 'person_email', 'person_datebirth',
    ];

    public static function getFilterableAttributes(): array
    {
        return [
            'num_document' => 'Documento',
            'person_name' => 'Nombre',
            'person_lastname' => 'Apellido',
            'person_phone' => 'Teléfono',

        ];
    }

    public static function documentExist(int $documentType, string $numdocument, $personId = null)
    {
        if ($personId) {
            return self::where('document_id', $documentType)
                ->where('num_document', $numdocument)
                ->where('id', '!=', $personId)
                ->exists();
        }

        return self::where('num_document', $numdocument)
            ->where('document_id', $documentType)
            ->exists();
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function maritalStatus(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function patiente(): HasOne
    {
        return $this->hasOne(Patient::class);
    }

    public function saveRelation(array $data, string $relation): Model
    {
        return $this->$relation()->create($data);
    }

    public function setCityIdAttribute($value)
    {
        $this->attributes['city_id'] = $value ?: null;
    }

    public function setGenderIdAttribute($value)
    {
        $this->attributes['gender_id'] = $value ?: null;
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

    public function scopeListPatients(Builder $query): Builder
    {
        return $query->whereHas('patiente');
    }

    protected function casts(): array
    {
        return [
            'document_id' => 'integer',
            'city_id' => 'integer',
            'gender_id' => 'integer',
            'marital_status_id' => 'integer',
            'occupation_id' => 'integer',
            'nationality_id' => 'integer',
            'person_datebirth' => 'date',
        ];
    }

    protected function getfullNameAttribute(): string
    {
        return $this->person_name.' '.$this->person_lastname;
    }

    protected function personName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str(str(str($value)->squish())->lower())->title(),
        );
    }

    protected function personLastname(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str(str(str($value)->squish())->lower())->title(),
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str(str($value)->squish())->lower(),
        );
    }

    protected function personEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),

        );
    }

    protected function personAddress(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => ucwords(mb_strtolower(trim($value))),
        );
    }

    protected function personPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }

    protected function numDocument(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }
}
