<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CurrencyFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Currency extends Model
{
    /**
     * @use HasFactory<CurrencyFactory>
     */
    use HasFactory;

    protected $fillable = [
        'state_id',
        'currency_code',
        'currency_name',
        'currency_symbol',
        'decimal_places',
        'is_base',
    ];

    protected function casts(): array
    {
        return ['decimal_places' => 'integer',
            'is_base' => 'boolean',
        ];
    }

    protected function currencyName(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function currencyCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    #[Scope]
    protected function byType(Builder $query, ?array $type): Builder
    {
        return $query->when($type, fn (Builder $q) => $q->whereIn('currency_code', $type));
    }

    #[Scope]
    protected function byEstatus(Builder $query, ?array $estatus): Builder
    {
        return $query->when($estatus, fn (Builder $q) => $q->whereIn('state_id', $estatus));
    }
}
