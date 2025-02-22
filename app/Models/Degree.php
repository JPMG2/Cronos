<?php

namespace App\Models;

use Database\Factories\DegreeFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    /** @use HasFactory<DegreeFactory> */
    use HasFactory;

    protected $fillable = [
        'degree_name',
        'degree_code',
    ];

    protected function degreeName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower(trim($value))),

        );
    }

    protected function degreeCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst(strtolower(trim($value))),

        );
    }
}
