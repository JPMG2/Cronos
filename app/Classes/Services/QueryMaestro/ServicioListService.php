<?php

declare(strict_types=1);

namespace App\Classes\Services\QueryMaestro;

use App\Interfaces\AbstractQueryService;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

final class ServicioListService extends AbstractQueryService
{
    protected function getRelationSearchField(string $relation): string
    {
        return match ($relation) {
            'state_name' => 'state',
            'categori_name' => 'category',
            default => 'name'
        };
    }

    protected function applyRelationshipOrder(EloquentBuilder $query, string $relationship, string $order): void
    {
        $tableName = $this->getTableName($relationship);
        $foreignKeyColumn = $this->getForeignKeyColumn($tableName);

        $query->join($tableName, "services.{$foreignKeyColumn}", '=', "{$tableName}.id")
            ->orderBy("{$tableName}.{$this->clickColumn}", $order)
            ->select('services.*');
    }

    protected function getDefaultOrderColumn(): string|array
    {
        return ['level', 'service_name'];
    }

    protected function checkOrderBy(EloquentBuilder $query): void
    {
        $query->orderByRaw(
            "COALESCE(
                (SELECT CONCAT(LPAD(COALESCE(p2.id::text, '0'), 10, '0'), '-', LPAD(services.id::text, 10, '0'))
                 FROM services p2
                 WHERE p2.id = services.parent_service_id),
                LPAD(services.id::text, 10, '0')
            )"
        )->orderBy('service_name', 'asc');
    }
}
