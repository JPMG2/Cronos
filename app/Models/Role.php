<?php

namespace App\Models;

use App\Traits\RecordActivity;
use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
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

    public function saveRelation(array $data)
    {
        return $this->actions()->sync($data);
    }

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class);
    }

    public function showData(int $id)
    {
        return self::with('actions')->findOrFail($id);
    }

    protected function nameRole(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower(trim($value))),

        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst(strtolower(trim($value))),

        );
    }
}
