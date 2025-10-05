<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class AbstractQueryService implements QueryListService
{
    protected Model $model;

    protected bool $order;

    protected ?string $clickColumn;

    public function __construct(Model $model, bool $order, ?string $clickColumn)
    {
        $this->model = $model;
        $this->order = $order;
        $this->clickColumn = $clickColumn;
    }

    abstract protected function getRelationSearchField(string $relation): string;

    abstract protected function applyRelationshipOrder(EloquentBuilder $query, string $relationship, string $order): void;

    abstract protected function getDefaultOrderColumn(): string|array;

    final public function listSearch(array $filterConditions): EloquentBuilder
    {
        $query = $this->model->newQuery();

        if ($this->clickColumn !== null) {
            $this->orderColumnBy($query);
        }

        $this->applyFilters($query, $filterConditions);

        return $this->getQueryDetails($query);
    }

    final public function getQueryDetails(EloquentBuilder $query): EloquentBuilder
    {
        $this->checkOrderBy($query);

        return $query->with($this->model::getRelationModel());
    }

    protected function checkOrderBy(EloquentBuilder $query)
    {
        $orderColumns = $this->getDefaultOrderColumn();

        if (is_array($orderColumns)) {
            foreach ($orderColumns as $column) {
                $query->orderBy($column, 'asc');
            }
        } else {
            $query->orderBy($orderColumns, 'asc');
        }
    }

    protected function getTableName(string $relation): string
    {
        return $this->model->{$relation}()->getRelated()->getTable();
    }

    protected function getForeignKeyColumn(string $tableName): string
    {
        return str()->endsWith($tableName, 's') ? str()->substr($tableName, 0, -1).'_id' : $tableName.'_id';
    }

    private function orderColumnBy(EloquentBuilder $query): void
    {
        $order = $this->getOrderDirection();
        $relationship = $this->getRelationSearchField($this->clickColumn);

        if ($relationship !== 'name') {
            $this->applyRelationshipOrder($query, $relationship, $order);
        } else {
            $query->orderBy($this->clickColumn, $order);
        }
    }

    private function getOrderDirection(): string
    {
        return $this->order ? 'desc' : 'asc';
    }

    private function applyFilters(EloquentBuilder $query, array $filterConditions): void
    {
        $nonEmptyFilters = array_filter($filterConditions, fn ($v): bool => $v !== '');

        foreach ($nonEmptyFilters as $key => $value) {
            $relation = $this->getRelationSearchField($key);
            if ($relation !== 'name') {
                $this->createQueryRelation($query, $relation, $value, $key);
            } else {
                $this->createQuery($query, $key, $value);
            }
        }
    }

    private function createQueryRelation(
        EloquentBuilder $query,
        string $relation,
        mixed $stringSearch,
        mixed $filterColumn
    ): void {
        $stringSearch = mb_strtolower((string) $stringSearch);

        $query->whereHas(
            $relation,
            function (EloquentBuilder $query) use ($stringSearch, $filterColumn) {
                $query->whereRaw('LOWER('.$filterColumn.') LIKE ?', ["%{$stringSearch}%"]);
            }
        );
    }

    private function createQuery(
        EloquentBuilder $query,
        int|string $column,
        mixed $stringSearch
    ): void {
        $stringSearch = mb_strtolower((string) $stringSearch);

        $query->where(DB::raw('LOWER('.$column.')'), 'like', "%{$stringSearch}%");

    }
}
