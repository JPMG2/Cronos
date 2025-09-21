<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\GenderFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Gender extends Model
{
    /**
     * @use HasFactory<GenderFactory>
     */
    use HasFactory;

    protected $fillable = ['gender_name'];

    protected function genderName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(mb_trim($value))),
        );
    }
}
