<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Company extends Model
{
    use HasFactory, RecordActivity, SoftDeletes;

    public string $checkchange = 'company_email';

    protected $fillable = ['city_id', 'state_id',
        'company_name', 'company_cuit', 'company_address',
        'company_phone', 'company_zipcode',
        'company_email', 'company_web',
        'company_person_contact', 'company_person_phone',
        'company_person_email'];

    public static function existCompany(): bool
    {
        return (bool) self::first();
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    protected function companyName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(trim($value))),

        );
    }

    protected function companyCuit(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }

    protected function companyAddress(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => ucwords(mb_strtolower(trim($value))),
        );
    }

    protected function companyPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }

    protected function companyZipcode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }

    protected function companyEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),
        );
    }

    protected function companyWeb(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),
        );
    }

    protected function companyPersonContact(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(trim($value))),
        );
    }

    protected function companyPersonPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),
        );
    }

    protected function companyPersonEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),
        );
    }
}
