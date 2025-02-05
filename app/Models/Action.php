<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['action_name', 'action_sp', 'action_inpass'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
