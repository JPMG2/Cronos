<?php

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceType extends Model
{
    use HasFactory, RecordActivity;

    protected $fillable = ['insuratype_name'];

    public function scopeListType(Builder $query): Builder
    {
        return $query->orderBy('insuratype_name');
    }

    protected function insuratypeName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower(trim($value))),
        );
    }
}
