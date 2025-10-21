<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class InsuranceType extends Model
{
    use HasFactory;
    use RecordActivity;

    protected $fillable = ['insuratype_name'];

    #[Scope]
    public function listType(Builder $query): Builder
    {
        return $query->orderBy('insuratype_name');
    }

    public function insurance(): HasMany
    {
        return $this->hasMany(Insurance::class);
    }

    protected function insuratypeName(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }
}
