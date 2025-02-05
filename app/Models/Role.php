<?php

namespace App\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<RoleFactory> */
    use HasFactory;

    protected $fillable = ['name_role'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class);
    }
}
