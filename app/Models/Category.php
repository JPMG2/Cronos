<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\RecordActivity;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Category extends Model
{
    /**
 * @use HasFactory<CategoryFactory> 
*/
    use HasFactory;

    use RecordActivity;
    use SoftDeletes;

    protected $fillable = ['categori_code', 'categori_name', 'state_id'];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

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
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }
}
