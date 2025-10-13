<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ServiceType;
use App\Traits\RecordActivity;
use Database\Factories\ServiceFactory;
use Exception;
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
    use HasFactory;
    use RecordActivity;

    /**
     * @use HasFactory<ServiceFactory>
     */
    use SoftDeletes;

    protected $fillable = [
        'service_name', 'service_description', 'service_code',
        'parent_service_id', 'level', 'path', 'category_id',
        'type', 'estimated_duration', 'requires_preparation',
        'preparation_instructions', 'state_id', 'display_order',
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
        // Si no tiene padre, puede ser raíz
        if (is_null($parentId)) {
            return true;
        }

        $parent = self::find($parentId);

        if (! $parent) {
            return false;
        }

        // El padre debe permitir sub-servicios
        if (! $parent->allows_subservices) {
            return false;
        }

        // No puede ser su propio padre
        if ($parent->id === $this->id) {
            return false;
        }

        // No puede ser hijo de uno de sus descendientes (evita ciclos)
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
            $child->saveQuietly(); // Sin disparar eventos
            $child->updateChildrenPaths(); // Recursivo
        }
    }

    /**
     * Relación: Servicio padre
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_service_id');
    }

    /**
     * Relación: Sub-servicios activos solamente
     */
    public function activeChildren(): HasMany
    {
        return $this->children()->where('active', true);
    }

    /**
     * Relación: Sub-servicios directos (hijos inmediatos)
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_service_id')
            ->orderBy('display_order')
            ->orderBy('service_name');
    }

    // ============================================
    // MÉTODOS DE JERARQUÍA
    // ============================================

    /**
     * Scope: Solo servicios raíz (sin padre)
     */
    public function scopeRoot(Builder $query): Builder
    {
        return $query->whereNull('parent_service_id')
            ->orderBy('display_order')
            ->orderBy('service_name');
    }

    /**
     * Scope: Solo servicios activos
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    /**
     * Scope: Filtrar por categoría
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Scope: Filtrar por nivel jerárquico
     */
    public function scopeByLevel(Builder $query, int $level): Builder
    {
        return $query->where('level', $level);
    }

    // ============================================
    // SCOPES (Filtros de consulta)
    // ============================================

    /**
     * Scope: Solo servicios agrupadores
     */
    public function scopeGroups(Builder $query): Builder
    {
        return $query->where('is_group', true);
    }

    /**
     * Scope: Solo servicios finales (no agrupadores)
     */
    public function scopeFinal(Builder $query): Builder
    {
        return $query->where('is_group', false);
    }

    /**
     * Scope: Buscar servicios por código o nombre
     */
    public function scopeSearch(Builder $query, string $search): Builder
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
     * Accessor: Cuenta total de hijos directos
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
     * Accessor: Ruta completa como string
     */
    public function getFullPathAttribute(): string
    {
        $names = $this->getAncestorNames();
        $names->push($this->service_name);

        return $names->implode(' > ');
    }

    // ============================================
    // ACCESSORS (Atributos calculados)
    // ============================================

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
                'is_group' => $child->is_group,
                'state' => $child->state->id,
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
        if (! $this->active) {
            return false;
        }

        return $this->getAncestors()->every(fn ($ancestor) => $ancestor->active);
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

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Boot the model.
     */
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
                $this->path = $parent->path ? $parent->path.'/'.$this->id : (string) $this->id;

                // Heredar categoría del padre si no tiene
                if (! $this->category && $parent->category) {
                    $this->category = $parent->category;
                }
            }
        } else {
            $this->level = 0;
            $this->path = (string) $this->id;
        }
    }

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
