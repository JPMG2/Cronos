<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property int $company_id
 * @property int $state_id
 * @property int $city_id
 * @property string $branch_name
 * @property string $branch_code
 * @property string $branch_address
 * @property string $branch_phone
 * @property ?string $branch_zipcode
 * @property string $branch_email
 * @property ?string $branch_web
 * @property string $branch_person_contact
 * @property string $branch_person_phone
 * @property string $branch_person_email
 * @property-read Company $company
 * @property-read State $state
 * @property-read City $city
 * @property-read Collection<int, Log> $logs
 * @property-read Collection<int, Department> $departments
 */
final class Branch extends Model
{
    use HasFactory;
    use RecordActivity;
    use SoftDeletes;

    public string $checkchange = 'branch_email';

    protected $fillable = [
        'company_id', 'state_id', 'city_id', 'branch_name',
        'branch_code', 'branch_address', 'branch_phone', 'branch_zipcode',
        'branch_email', 'branch_web', 'branch_person_contact', 'branch_person_phone',
        'branch_person_email',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'model');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class)
            ->withPivot('state_id')
            ->withTimestamps();
    }

    public function mainName(): string
    {
        return $this->branch_name;
    }

    public function showData(int $id, string $relashion)
    {

        return $this->$relashion($id);
    }

    public function showDataRelashion(int $id)
    {
        return self::with('city.province', 'state')->findOrFail($id);
    }

    #[\Illuminate\Database\Eloquent\Attributes\Scope]
    protected function countBranch(Builder $query): ?int
    {
        return $query->count();
    }

    protected function casts(): array
    {
        return [
            'company_id' => 'integer',
            'state_id' => 'integer',
            'city_id' => 'integer',
        ];
    }

    protected function branchName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function branchCuit(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => mb_trim($value),
        );
    }

    protected function branchAddress(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function branchPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => mb_trim($value),
        );
    }

    protected function branchZipcode(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => mb_trim($value),
        );
    }

    protected function branchEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }

    protected function branchWeb(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }

    protected function branchPersonContact(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function branchPersonPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }

    protected function branchPersonEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(mb_trim($value)),
        );
    }
}
