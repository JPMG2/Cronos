<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Action extends Model
{
    use HasFactory, RecordActivity;

    protected $fillable = ['action_name', 'action_sp', 'action_inpass'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
