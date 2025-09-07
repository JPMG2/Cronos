<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Filterable;
use App\Traits\RecordActivity;
use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Service extends Model implements Filterable
{
    /** @use HasFactory<ServiceFactory> */
    use HasFactory, RecordActivity;

    protected $fillable = [
        'service_name',
        'service_description',
        'service_code',
    ];

    protected $casts = [
        'service_name' => 'string',
        'service_description' => 'string',
        'service_code' => 'string',
    ];

    public static function getDefaultFilterField(): string
    {
        return 'service_name';
    }
}
