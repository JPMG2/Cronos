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

        $query->join($tableName, "categories.{$foreignKeyColumn}", '=', "{$tableName}.id")
            ->orderBy("{$tableName}.{$this->clickColumn}", $order)
            ->select('categories.*');
    }

    protected function getDefaultOrderColumn(): string|array
    {
        return ['service_name', 'category_id'];
    }
}
