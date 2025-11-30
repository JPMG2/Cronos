<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $day_of_week
 * @property bool $is_active
 * @property ?string $morning_start
 * @property ?string $morning_end
 * @property ?string $afternoon_start
 * @property ?string $afternoon_end
 */
final class Schedule extends Model
{
    /**
     * @use HasFactory<\Database\Factories\ScheduleFactory>
     */
    use HasFactory;
}
