<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property ?int $menu_id
 * @property ?string $name_menu
 * @property ?string $grup_menu
 * @property ?bool $title_menu
 * @property ?string $header_menu
 * @property ?string $icon_menu
 * @property ?string $descripcion
 * @property ?string $linkto
 * @property-read Collection<int, Menu> $menus
 * @property-read Collection<int, Menu> $optionmenus
 * @property-read Collection<int, Role> $roles
 */
final class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'name_menu', 'grup_menu', 'title_menu',
        'icon_menu', 'linkto', 'header_menu', 'descripcion',
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(self::class)->orderBy('id', 'asc');
    }

    public function optionmenus(): HasMany
    {
        return once(
            fn () => $this->hasMany(self::class, 'menu_id', 'id')
                ->withCount('menus')
                ->with('menus'),
        );
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
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
