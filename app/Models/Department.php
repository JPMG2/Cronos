<?php

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends Model
{
    use HasFactory, RecordActivity;

    public string $checkchange = 'department_name';

    protected $fillable = ['department_name', 'department_code'];

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class)
            ->withPivot('state_id')
            ->withTimestamps();
    }

    public function scopeListDepartment(Builder $query, $department = null): Builder
    {
        return $query->where('department_name', 'like', "%$department%")
            ->orderBy('department_name');
    }

    protected function departmentName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower(trim($value))),
        );
    }

    protected function departmentCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper(strtolower(trim($value))),
        );
    }
}
