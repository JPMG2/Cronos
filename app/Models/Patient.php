<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Filterable;
use Database\Factories\PatientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $person_id
 * @property ?int $blood_type_id
 * @property ?string $patient_photo
 * @property ?string $patient_weight
 * @property ?string $patient_height
 * @property-read Person $person
 */
final class Patient extends Model implements Filterable
{
    /**
     * @use HasFactory<PatientFactory>
     */
    use HasFactory;

    protected $fillable = [
        'person_id', 'blood_type_id', 'patient_photo', 'patient_weight', 'patient_height',
    ];

    public static function getDefaultFilterField(): string
    {
        return 'person_name';
    }

    public static function getRelationModel(): array
    {
        return [
            'person:*',
            'person.document:id,document_name',
            'person.gender:id,gender_name',
            'person.province:id,province_name',
        ];
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    protected function casts(): array
    {
        return [
            'person_id' => 'integer',
            'patient_photo' => 'string',
        ];
    }
}
