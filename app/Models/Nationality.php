<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\NationalityFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Nationality extends Model
{
    /** @use HasFactory<NationalityFactory> */
    use HasFactory;

    protected $fillable = ['nationality_name'];

    protected function nationalityName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(mb_trim($value))),

        );
    }
}
