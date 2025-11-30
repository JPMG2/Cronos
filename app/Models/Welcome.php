<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * @property string $activity
 * @property-read Collection<int, Log> $logs
 */
final class Welcome extends Model
{
    use HasFactory;

    protected $fillable = ['activity'];

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'model');
    }
}
