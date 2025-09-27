<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

final class City extends Model
{
    use HasFactory;

    protected $fillable = ['province_id', 'city_name'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function scopeCitySearch(Builder $query, $idprovince = null, $citysearc = null): Builder
    {
        if ($idprovince > 0) {
            $cacheKey = 'city_search_'.md5($idprovince.'_'.$citysearc);

            $cachedIds = Cache::remember(
                $cacheKey, now()->addHours(24), function () use ($idprovince, $citysearc) {
                    return static::where('province_id', $idprovince)
                        ->where('city_name', 'like', '%'.$citysearc.'%')
                        ->orderBy('city_name', 'asc')
                        ->pluck('id')
                        ->toArray();
                }
            );

            return $query->whereIn('id', $cachedIds)->orderBy('city_name', 'asc');
        }

        return $query->whereRaw('1 = 0');
    }

    protected function cityName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str(str(str($value)->squish())->lower())->title(),
        );
    }
}
