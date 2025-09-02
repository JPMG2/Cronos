<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Filterable;
use App\Traits\DbTraits\TableFilter;
use App\Traits\RecordActivity;
use Database\Factories\MedicalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Medical extends Model implements Filterable
{
    /** @use HasFactory<MedicalFactory> */
    use HasFactory, RecordActivity, TableFilter;

    protected $fillable = [
        'person_id',
        'credential_id',
        'specialty_id',
        'degree_id',
    ];

    public static function getDefaultFilterField(): string
    {
        return 'person_name';
    }

    public static function getRelationModel(): array
    {
        return [
            'person:id,person_name,person_lastname,num_document,document_id,person_address,person_phone,person_email',
            'person.document:id,document_name',
            'specialty:id,specialty_name',
            'degree:id,degree_name',
            'credentials' => function ($query): void {
                $query->select('credentials.id', 'credentials.credential_name', 'credentials.credential_code')
                    ->withPivot('credential_number');
            },

        ];
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class);
    }

    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function getFirstCredentialNumberAttribute(): ?string
    {
        if (! $this->relationLoaded('credentials')) {
            $this->loadMissing('credentials');
        }

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
            'credential_id' => 'integer',
            'specialty_id' => 'integer',
            'degree_id' => 'integer',
        ];
    }
}
