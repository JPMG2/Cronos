<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property string $action_name
 * @property ?string $action_sp
 * @property string $action_inpass
 * @property-read Collection<int, Role> $roles
 */
final class Action extends Model
{
    // use HasFactory, RecordActivity;
    use HasFactory;

    protected $fillable = ['action_name', 'action_sp', 'action_inpass'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
