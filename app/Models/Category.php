<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CategoryFactory;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Attributes\Scope;
>>>>>>> 3514fa4 (Refactor `CommonQuerys` to `CommonQueries` across the codebase for improved naming consistency, update `CompanyWatcher`.)
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['categori_code', 'categori_name', 'state_id'];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

<<<<<<< HEAD
=======
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    #[Scope]
    protected function list($query, ?array $states, ?string $search = null)
    {
        if ($search) {
            $query->whereRaw('LOWER(categori_name::text) like ?', ["%{$search}%"]);
        }
        if ($states) {
            $query->whereIn('state_id', $states);
        }

        return $query->with(['state'])
            ->orderBy('categori_name', 'ASC');
    }

>>>>>>> 3514fa4 (Refactor `CommonQuerys` to `CommonQueries` across the codebase for improved naming consistency, update `CompanyWatcher`.)
    protected function casts(): array
    {
        return ['state_id' => 'integer'];
    }

    protected function categoriCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function categoriName(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }
}
