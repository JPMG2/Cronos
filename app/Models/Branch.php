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

final class Branch extends Model
{
    use HasFactory, RecordActivity, SoftDeletes;

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

    public function scopeCountBranch(Builder $query): ?int
    {
        return $query->count();
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
            set: fn ($value) => mb_strtoupper(mb_strtolower(trim($value))),

        );
    }

    protected function branchCuit(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }

    protected function branchAddress(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => ucwords(mb_strtolower(trim($value))),
        );
    }

    protected function branchPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }

    protected function branchZipcode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
        );
    }

    protected function branchEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),
        );
    }

    protected function branchWeb(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),
        );
    }

    protected function branchPersonContact(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(trim($value))),
        );
    }

    protected function branchPersonPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),
        );
    }

    protected function branchPersonEmail(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower(trim($value)),
        );
    }
}
