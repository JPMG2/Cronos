<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\OccupationFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $occupation_name
 */
final class Occupation extends Model
{
    /**
     * @use HasFactory<OccupationFactory>
     */
    use HasFactory;

    protected $fillable = ['occupation_name'];

    protected function occupationName(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }
}
