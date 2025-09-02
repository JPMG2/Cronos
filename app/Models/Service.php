<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Filterable;
use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Service extends Model implements Filterable
{
    /** @use HasFactory<ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'service_name',
        'service_description',
        'service_code',
        'state_id',
    ];

    protected $casts = [
        'service_name' => 'string',
        'service_description' => 'string',
        'service_code' => 'string',
        'state_id' => 'integer',
    ];

    public static function getDefaultFilterField(): string
    {
        return 'service_name';
    }

    public static function getRelationModel(): array
    {
        return [
            'state:id,state_name',
        ];
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
