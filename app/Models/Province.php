<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Province extends Model
{
    use HasFactory;

    protected $fillable = ['province_name'];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function scopeProviceSearch(Builder $query, $value): ?Builder
    {

        if ($value === '') {
            return null;
        }

        return once(function () use ($query, $value) {
            return $query->where('province_name', 'like', '%'.$value.'%')
                ->orderBy('province_name');
        });
    }

    protected function provinceName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str(str(str($value)->squish())->lower())->title(),
            set: fn ($value) => str(str(str($value)->squish())->lower())->title(),
        );
    }
}
