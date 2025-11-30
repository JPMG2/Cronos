<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\BloodTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $blood_type_name
 */
final class BloodType extends Model
{
    /**
     * @use HasFactory<BloodTypeFactory>
     */
    use HasFactory;
}
