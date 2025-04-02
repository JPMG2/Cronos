<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\PatientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Patient extends Model
{
    /** @use HasFactory<PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'person_id',
        'patient_address', 'patient_photo'];

    protected function casts(): array
    {
        return [
            'person_id' => 'integer',
            'patient_datebirth' => 'date',
        ];
    }
}
