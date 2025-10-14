<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ServiceType;
use App\Traits\RecordActivity;
use Database\Factories\ServiceFactory;
use Exception;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

final class Service extends Model
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
    ];

    protected $appends = [
        'has_children',
        'children_count',
        'is_root',
        'is_active',
        'full_path',
        'allows_children',
    ];

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
     * Scope: Solo servicios raíz (sin padre)
     */
    public function scopeRoot(Builder $query): Builder
    {
        return $query->whereNull('parent_service_id')
            ->orderBy('display_order')
            ->orderBy('service_name');
    }

    #[Scope]
    public function active(Builder $query): Builder
    {
        return $query->whereHas('state', function ($q) {
            $q->where('id', 1);
        });
    }

    #[Scope]
    public function inactive(Builder $query): Builder
    {
        return $query->whereHas('state', function ($q) {
            $q->where('id', 2);
        });
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

    /**
     * Only services of type 'group' (can have children)
     */
    #[Scope]
    public function groups(Builder $query): Builder
    {
        return $query->where('type', ServiceType::GROUP);
    }

    /**
     * Only services of type 'final' (no children)
     */
    #[Scope]
    public function final(Builder $query): Builder
    {
        return $query->where('type', ServiceType::FINAL);
    }

    #[Scope]
    public function listServices(Builder $query, array $states): Builder
    {
        if ($states) {
            $query->whereIn('state_id', $states);
        }

        return $query->with(['state', 'category', 'children']);
    }

    /**
     * Scope: Buscar servicios por código o nombre
     */
    #[Scope]
    public function search(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('service_code', 'like', "%{$search}%")
                ->orWhere('service_name', 'like', "%{$search}%")
                ->orWhere('service_description', 'like', "%{$search}%");
        });
    }

    /**
     * Accessor: Verifica si tiene hijos
     */
    public function getHasChildrenAttribute(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Count numbers of children
     */
    public function getChildrenCountAttribute(): int
    {
        return $this->children()->count();
    }

    /**
     * Accessor: Verifica si es servicio raíz
     */
    public function getIsRootAttribute(): bool
    {
        return is_null($this->parent_service_id);
    }

    /**
     * Accessor: Verifica si está activo
     */
    public function getIsActiveAttribute(): bool
    {
        return $this->state && $this->state->state_name === 'Activo';
    }

    /**
     * Accessor: Ruta completa como string
     */

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
     * Accessor: Verifica si permite hijos (basado en type)
     */
    public function getAllowsChildrenAttribute(): bool
    {
        return $this->type === ServiceType::GROUP;
    }

    /**
     * Obtiene el árbol completo de sub-servicios
     */
    public function getServiceTree(bool $activeOnly = false): Collection
    {
        $children = $activeOnly ? $this->activeChildren : $this->children;

        return $children->map(function ($child) use ($activeOnly) {
            return [
                'id' => $child->id,
                'code' => $child->service_code,
                'name' => $child->service_name,
                'description' => $child->service_description,
                'level' => $child->level,
                'type' => $child->type->value,
                'is_active' => $child->is_active,
                'children' => $child->getServiceTree($activeOnly),
            ];
        });
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
     * Obtiene el breadcrumb completo del servicio
     */
    public function getBreadcrumb(): array
    {
        $breadcrumb = [];

        foreach ($this->getAncestors() as $ancestor) {
            $breadcrumb[] = [
                'id' => $ancestor->id,
                'name' => $ancestor->service_name,
                'code' => $ancestor->service_code,
            ];
        }

        $breadcrumb[] = [
            'id' => $this->id,
            'name' => $this->service_name,
            'code' => $this->service_code,
        ];

        return $breadcrumb;
    }

    /**
     * Cuenta total de descendientes
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

    protected static function boot()
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
                    throw new Exception('No se puede crear un ciclo en la jerarquía de servicios.');
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

    // ============================================
    // CASTS Y MUTATORS
    // ============================================

    protected function casts(): array
    {
        return [
            'type' => ServiceType::class,
            'level' => 'integer',
            'estimated_duration' => 'integer',
            'requires_preparation' => 'boolean',
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
}
