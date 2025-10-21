<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SpecialtyFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Specialty extends Model
{
    /**
     * @use HasFactory<SpecialtyFactory>
     */
    use HasFactory;

    protected $fillable = [
        'specialty_name',
    ];

    protected function specialtyName(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }
}
