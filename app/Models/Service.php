<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\RecordActivity;
use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Service extends Model
{
    /**
     * @use HasFactory<ServiceFactory>
     */
    use HasFactory;

    use RecordActivity;

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

    protected function serviceName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function serviceCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function serviceDescription(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }
}
