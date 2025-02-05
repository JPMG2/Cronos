<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'name_menu', 'grup_menu', 'title_menu',
        'icon_menu', 'linkto', 'header_menu', 'descripcion'];

    public function menus(): HasMany
    {
        return $this->hasMany(self::class)->orderBy('id', 'asc');
    }

    public function optionmenus(): HasMany
    {
        return once(function () {
            return $this->hasMany(self::class, 'menu_id', 'id')
                ->withCount('menus')
                ->with('menus');
        });
    }

    protected function grupMenu(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => str()->ucfirst(str()->lower(str()->squish($value))),
        );
    }

    protected function nameMenu(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => str()->ucfirst(str()->lower(str()->squish($value))),
        );
    }

    protected function iconMenu(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => str()->squish($value),
        );
    }

    protected function linkto(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => str()->lower(str()->squish($value)),
        );
    }

    protected function descripcion(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => str()->ucfirst(str()->squish($value)),
        );
    }
}
