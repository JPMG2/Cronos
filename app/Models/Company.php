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
use Illuminate\Support\Collection;

/**
 * @property int $state_id
 * @property int $city_id
 * @property string $company_name
 * @property string $company_cuit
 * @property string $company_address
 * @property string $company_phone
 * @property ?string $company_zipcode
 * @property string $company_email
 * @property ?string $company_web
 * @property string $company_person_contact
 * @property string $company_person_phone
 * @property string $company_person_email
 * @property-read City $city
 * @property-read State $state
 * @property-read Collection<int, Branch> $branches
 */
final class Company extends Model
{
    use HasFactory;
    use RecordActivity;
    use SoftDeletes;

    public string $checkchange = 'company_email';

    protected $fillable = ['city_id', 'state_id',
        'company_name', 'company_cuit', 'company_address',
        'company_phone', 'company_zipcode',
        'company_email', 'company_web',
        'company_person_contact', 'company_person_phone',
        'company_person_email',
    ];

    public static function existCompany(): bool
    {
        return (bool) self::query()->first();
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
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function companyCuit(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => mb_trim($value),
        );
    }

    protected function companyAddress(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function companyPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => mb_trim($value),
        );
    }

    protected function companyZipcode(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => mb_trim($value),
        );
    }

    protected function companyEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }

    protected function companyWeb(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }

    protected function companyPersonContact(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function companyPersonPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }

    protected function companyPersonEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }
}
