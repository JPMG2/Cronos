<?php

namespace App\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<RoleFactory> */
    use HasFactory;

    protected $fillable = ['name_role', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class);
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
