<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\DegreeFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $degree_name
 * @property string $degree_code
 */
final class Degree extends Model
{
    /**
     * @use HasFactory<DegreeFactory>
     */
    use HasFactory;

    protected $fillable = [
        'degree_name',
        'degree_code',
    ];

    protected function degreeName(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function degreeCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }
}
