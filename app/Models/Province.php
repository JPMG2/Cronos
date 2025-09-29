<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

final class Province extends Model
{
    use HasFactory;

    protected $fillable = ['province_name'];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function scopeProviceSearch(Builder $query, $value): Builder
    {
        if ($value === '') {
            return $query->whereRaw('1 = 0');
        }

        $cacheKey = 'province_search_'.md5($value);

        $cachedIds = Cache::remember(
            $cacheKey,
            now()->addHours(24),
            function () use ($value) {
                return static::where('province_name', 'like', '%'.$value.'%')
                    ->orderBy('province_name')
                    ->pluck('id')
                    ->toArray();
            }
        );

        return $query->whereIn('id', $cachedIds)->orderBy('province_name');
    }

    protected function provinceName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str(str(str($value)->squish())->lower())->title(),
            set: fn ($value) => str(str(str($value)->squish())->lower())->title(),
        );
    }
}
