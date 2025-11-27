<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\ServiceType;
use App\Interfaces\Filterable;
use App\Traits\RecordActivity;
use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

final class Service extends Model implements Filterable
{
    /** @use HasFactory<ServiceFactory> */
    use HasFactory;

    use RecordActivity;
    use SoftDeletes;

    protected $fillable = [
        'service_code',
        'service_name',
        'service_description',
        'state_id',
        'category_id',
        'parent_service_id',
        'level',
        'path',
        'type',
        'display_order',
        'estimated_duration',
        'requires_preparation',
        'preparation_instructions',
        'base_price',
    ];

    protected $appends = [
        'has_children',
        'children_count',
        'is_root',
        'full_path',
        'allows_children',
    ];

    public static function getDefaultFilterField(): string
    {
        return 'service_code';
    }

    public static function getRelationModel(): array
    {
        return [
            'state:id,state_name',
            'category:id,categori_code,categori_name',
        ];
    }

    /**
     * Verifica si puede ser hijo de otro servicio
     * (Previene ciclos y valida restricciones)
     */
    public function canBeChildOf(?int $parentId): bool
    {
        if (is_null($parentId)) {
            return true;
        }

        $parent = self::find($parentId);

        if (! $parent) {
            return false;
        }

        // El padre debe ser tipo 'group'
        if ($parent->type !== ServiceType::GROUP) {
            return false;
        }

        // No puede ser su propio padre
        if ($parent->id === $this->id) {
            return false;
        }

        // No puede ser hijo de uno de sus descendientes
        if ($this->exists && $this->isAncestorOf($parent)) {
            return false;
        }

        return true;
    }

    /**
     * Actualiza las rutas de todos los hijos recursivamente
     */
    public function updateChildrenPaths(): void
    {
        foreach ($this->children as $child) {
            $child->updateHierarchyData();
            $child->saveQuietly();
            $child->updateChildrenPaths();
        }
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_service_id');
    }

    /**
     * Relación: Sub-servicios activos solamente
     */
    public function activeChildren(): HasMany
    {
        return $this->children()->whereHas('state', function ($query) {
            $query->where('state_name', 'Activo');
        });
    }

    /**
     * Relación: Sub-servicios directos (hijos inmediatos)
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_service_id')
            ->orderBy('service_name');
    }

    /**
     * Order by category and display order
     */
    #[Scope]
    public function byCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Filter by level
     */
    #[Scope]
    public function byLevel(Builder $query, int $level): Builder
    {
        return $query->where('level', $level);
    }

    #[Scope]
    public function byState(Builder $query, ?array $arrayState): Builder
    {
        return $query->when($arrayState, fn ($q) => $q->whereIn('state_id', $arrayState));
    }

    /**
     * Only services of type 'group' (can have children)
     */
    #[Scope]
    public function groups(Builder $query): Builder
    {
        return $query->where('type', ServiceType::GROUP);
    }

    /**
     * Obtiene solo los nombres de los ancestros
     */
    public function getAncestorNames(): Collection
    {
        return $this->getAncestors()->pluck('service_name');
    }

    /**
     * Obtiene todos los ancestros (padres, abuelos, etc.)
     */
    public function getAncestors(): Collection
    {
        $ancestors = collect();
        $service = $this;

        while ($service->parent) {
            $service = $service->parent;
            $ancestors->prepend($service);
        }

        return $ancestors;
    }

    /**
     * Verifica si es descendiente de otro servicio
     */
    public function isDescendantOf(self $service): bool
    {
        return $service->isAncestorOf($this);
    }

    /**
     * Verifica si es ancestro de otro servicio
     */
    public function isAncestorOf(self $service): bool
    {
        return $service->getAncestors()->contains('id', $this->id);
    }

    /**
     * Count descends children
     */
    public function countAllDescendants(): int
    {
        return $this->getDescendants()->count();
    }

    /**
     * Obtiene todos los descendientes (hijos, nietos, etc.)
     */
    public function getDescendants(bool $activeOnly = false): Collection
    {
        $descendants = collect();
        $children = $activeOnly ? $this->activeChildren : $this->children;

        foreach ($children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->getDescendants($activeOnly));
        }

        return $descendants;
    }

    /**
     * Verifica si el servicio y todos sus ancestros están activos
     */
    public function isFullyActive(): bool
    {
        if (! $this->is_active) {
            return false;
        }

        return $this->getAncestors()->every(fn ($ancestor) => $ancestor->is_active);
    }

    /**
     * Obtiene el nivel máximo de profundidad desde este servicio
     */
    public function getMaxDepth(): int
    {
        $descendants = $this->getDescendants();

        if ($descendants->isEmpty()) {
            return 0;
        }

        return $descendants->max('level') - $this->level;
    }

    protected static function boot(): void
    {
        parent::boot();

        // Al crear un servicio, actualizar automáticamente nivel y ruta
        self::creating(function ($service) {
            $service->updateHierarchyData();
        });

        // Al actualizar, verificar si cambió el padre
        self::updating(function ($service) {
            if ($service->isDirty('parent_service_id')) {
                // Validar que no se cree un ciclo
                if (! $service->canBeChildOf($service->parent_service_id)) {
                    // throw new Exception('No se puede crear un ciclo en la jerarquía de servicios.');
                }
                $service->updateHierarchyData();
            }
        });

        // Después de actualizar, actualizar rutas de hijos
        self::updated(function ($service) {
            if ($service->wasChanged('parent_service_id')) {
                $service->updateChildrenPaths();
            }
        });
    }

    /**
     * Actualiza nivel y ruta según el padre
     */
    protected function updateHierarchyData(): void
    {
        if ($this->parent_service_id) {
            $parent = self::find($this->parent_service_id);

            if ($parent) {
                $this->level = $parent->level + 1;

                // Heredar categoría del padre si no tiene
                if (! $this->category_id && $parent->category_id) {
                    $this->category_id = $parent->category_id;
                }
            }
        } else {
            $this->level = 0;
        }
    }

    /**
     * Scope: Solo servicios raíz (sin padre)
     */
    #[Scope]
    protected function root(Builder $query): Builder
    {
        return $query->whereNull('parent_service_id')
            ->orderBy('display_order')
            ->orderBy('service_name');
    }

    /**
     * Accessor: Ruta completa como string
     */
    protected function getFullPathAttribute(): string
    {
        $ancestors = $this->getAncestors();
        $names = $ancestors->pluck('service_name')->push($this->service_name);

        return $names->implode(' > ');
    }

    #[Scope]
    protected function listServices(Builder $query, array $states): Builder
    {
        if ($states) {
            $query->whereIn('state_id', $states);
        }

        return $query->with(['state', 'category', 'children']);
    }

    /**
     * Only services of type 'final' (no children)
     */
    #[Scope]
    protected function final(Builder $query): Builder
    {
        return $query->where('type', ServiceType::FINAL)
            ->whereNull('parent_service_id');
    }

    /**
     *  Check if the services can have children
     */
    protected function getAllowsChildrenAttribute(): bool
    {
        return $this->type === ServiceType::GROUP;
    }

    /**
     *  Check if service root
     */
    protected function getIsRootAttribute(): bool
    {
        return is_null($this->parent_service_id);
    }

    /**
     * Check if has children
     */
    protected function getHasChildrenAttribute(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Count numbers of children
     */
    protected function getChildrenCountAttribute(): int
    {
        return $this->children()->count();
    }

    protected function casts(): array
    {
        return [
            'type' => ServiceType::class,
            'level' => 'integer',
            'estimated_duration' => 'integer',
            'requires_preparation' => 'boolean',
            'base_price' => MoneyCast::class,
            'display_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected function serviceName(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function serviceCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim($value))),
        );
    }

    protected function serviceDescription(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }

    protected function preparationInstructions(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }

    protected function basePriceFormatted(): Attribute
    {
        return Attribute::make(
            get: fn (): string => formatMoney($this->base_price),
        );
    }
}
