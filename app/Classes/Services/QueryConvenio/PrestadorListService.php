<?php

declare(strict_types=1);

namespace App\Classes\Services\QueryConvenio;

use App\Models\Insurance;
use DB;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

final class PrestadorListService
{
    private Model $model;

    private bool $order;

    private ?string $clickColumn;

    public function __construct(Insurance $model, bool $order, ?string $clickColumn)
    {
        $this->model = $model;
        $this->order = $order;
        $this->clickColumn = $clickColumn;

    }

    public function listSearch(array $filterConditions): EloquentBuilder
    {
        $query = $this->model->newQuery();

        if ($this->clickColumn !== null) {
            $this->orderColumnBy($query);
        }

        $this->applyFilters($query, $filterConditions);

        return $this->getQueryDetails($query);
    }

    public function getQueryDetails(EloquentBuilder $query): EloquentBuilder
    {
        return $query->orderBy($this->model::$startFilterBay, 'asc')
            ->with($this->model::getRelationModel());
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

    private function getRelationSearchField(string $relation): string
    {
        return match ($relation) {
            'state_name' => 'state',
            'insuratype_name' => 'insuranceType',
            default => 'name'
        };
    }

    private function getTableName(string $relation): string
    {
        return $this->model->{$relation}()->getRelated()->getTable();
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

    private function applyRelationshipOrder(EloquentBuilder $query, string $relationship, string $order): void
    {
        $tableName = $this->getTableName($relationship);
        $foreignKeyColumn = $this->getForeignKeyColumn($tableName);

        $query->join($tableName, "insurances.{$foreignKeyColumn}", '=', "{$tableName}.id")
            ->orderBy("{$tableName}.{$this->clickColumn}", $order)
            ->select('insurances.*');
    }

    private function getForeignKeyColumn(string $tableName): string
    {
        return str()->endsWith($tableName, 's') ? str()->substr($tableName, 0, -1).'_id' : $tableName.'_id';
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
                $query->where(DB::raw('LOWER('.$filterColumn.')'), 'like', "%{$stringSearch}%");
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
