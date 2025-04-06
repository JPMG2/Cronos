<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Log extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action_id', 'model_id', 'model_type', 'log_message', 'log_change'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }
}
