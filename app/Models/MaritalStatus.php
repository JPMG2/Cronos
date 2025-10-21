<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\MaritalStatusFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class MaritalStatus extends Model
{
    /**
     * @use HasFactory<MaritalStatusFactory>
     */
    use HasFactory;

    protected $fillable = ['maritalstatus_name'];

    protected function maritalstatusName(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }
}
