<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['province_id', 'city_name'];

    protected function cityName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str(str(str($value)->squish())->lower())->title(),
        );
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function scopeCitySearch(Builder $query, $idprovince = null, $citysearc = null): ?Builder
    {
        if ($idprovince > 0) {
            return once(function () use ($query, $idprovince, $citysearc) {
                return $query->where('province_id', $idprovince)
                    ->where('city_name', 'like', '%'.$citysearc.'%')
                    ->orderBy('city_name', 'asc');
            });
        }

        return null;
    }
}
