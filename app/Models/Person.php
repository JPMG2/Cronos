<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Filterable;
use App\Traits\DbTraits\TableFilter;
use Carbon\CarbonImmutable;
use Database\Factories\PersonFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $document_id
 * @property ?int $city_id
 * @property ?int $gender_id
 * @property ?int $marital_status_id
 * @property ?int $occupation_id
 * @property ?int $nationality_id
 * @property string $num_document
 * @property string $person_name
 * @property string $person_lastname
 * @property ?string $person_address
 * @property ?string $person_phone
 * @property ?string $person_email
 * @property CarbonImmutable $person_datebirth
 */
final class Person extends Model implements Filterable
{
    /** @use HasFactory<PersonFactory> */
    use HasFactory,TableFilter;

    protected $fillable = [
        'document_id', 'city_id', 'gender_id', 'marital_status_id', 'occupation_id',
        'nationality_id', 'num_document', 'person_name', 'person_lastname',
        'person_address', 'person_phone', 'person_email', 'person_datebirth',
    ];

    protected $casts = [
        'document_id' => 'integer',
        'city_id' => 'integer',
        'gender_id' => 'integer',
        'marital_status_id' => 'integer',
        'occupation_id' => 'integer',
        'nationality_id' => 'integer',
        'person_datebirth' => 'date',
    ];

    public static function getDefaultFilterField(): string
    {
        return 'num_document';
    }

    public static function getFilterableAttributes(): array
    {
        return [
            'num_document' => 'Documento',
            'person_name' => 'Nombre',
            'person_lastname' => 'Apellido',
            'person_phone' => 'Teléfono',
        ];
    }

    public static function documentExist(int $documentType, string $numDocument, $personId = null): bool
    {
        $query = self::query()->where('document_id', $documentType)
            ->where('num_document', $numDocument);

        if ($personId) {
            $query->where('id', '!=', $personId);
        }

        return $query->exists();

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

    public function medical(): HasOne
    {
        return $this->hasOne(Medical::class);
    }

    public function saveRelation(array $data, string $relation): Model
    {
        return $this->$relation()->create($data);
    }

    public function updateRelation(array $data, string $relation): int
    {
        return $this->$relation()->update($data);
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

    public function scopeListPatients(Builder $query, $searchTerm = null, $relationship = null): Builder
    {
        if (! is_null($relationship)) {

            $relationName = $this->getRelashionName($relationship);

            if (method_exists($this, $relationship)) {
                return $this->{$relationship}($query, $relationName, $searchTerm, ['gender', 'maritalStatus', 'occupation', 'nationality', 'city']);
            }
        }

        return $query->whereHas('patiente')->with(['gender', 'maritalStatus', 'occupation', 'nationality', 'city']);

    }

    public function getRelashionName(string $relashionvalue): string
    {
        $relashionarray = [
            'city_id' => 'city',
            'gender_id' => 'gender',
            'marital_status_id' => 'maritalStatus',
            'occupation_id' => 'occupation',
            'nationality_id' => 'nationality', ];

        return $relashionarray[$relashionvalue];

    }

    public function showData(int $id, string $relashion)
    {

        return $this->$relashion($id);
    }

    public function showDataPatient(int $id)
    {
        return self::whereHas('patiente')->with(['gender', 'maritalStatus', 'occupation', 'nationality', 'city'])
            ->findOrFail($id);
    }

    public function hasEmail(): bool
    {
        return $this->person_email !== '';
    }

    public function getdocumentInfoAttribute(): string
    {
        $typeDocument = $this->document->document_name;

        return "$typeDocument. ".$this->num_document;
    }

    protected function getfullNameAttribute(): string
    {
        return $this->person_name.' '.$this->person_lastname;
    }

    protected function personName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function personLastname(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }

    protected function personEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),

        );
    }

    protected function personAddress(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }

    protected function personPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_trim($value),
        );
    }

    protected function numDocument(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_trim($value),
        );
    }

    protected function personDatebirth(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => CarbonImmutable::parse($value)->format('d-m-Y'),
            set: fn ($value) => CarbonImmutable::parse($value)->format('Y-m-d'),
        );
    }
}
