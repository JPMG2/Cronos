<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\RecordActivity;
use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Role extends Model
{
    /** @use HasFactory<RoleFactory> */
    use HasFactory, RecordActivity;

    protected $fillable = ['name_role', 'description'];

    public static function countRoles()
    {
        return self::whereNot('name_role', 'Owner')->count();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function saveRelation(array $data, string $relation): array
    {
        return $this->$relation()->sync($data);
    }

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class);
    }

    public function showData(int $id, string $relashion)
    {

        return $this->$relashion($id);
    }

    public function showActionRelashion(int $id)
    {
        return self::with('actions')->findOrFail($id);
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }

    public function hasMenu($menulink): bool
    {
        return $this->menus()->where('linkto', $menulink)->exists();
    }

    protected function nameRole(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(trim($value))),

        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst(mb_strtolower(trim($value))),

        );
    }
}
