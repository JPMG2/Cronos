<?php

/**
 * Trait TableSorting
 *
 * Provides utility methods to handle table sorting and query building functionality
 * for database interactions within a Laravel application, including ordering and
 * searching capabilities by specific columns.
 */

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Trait TableSorting
 * Provides functionalities to handle table sorting and filtering in a structured manner.
 */
trait TableSorting
{
    public $sortField;

    public $columName;

    public $filtervalue;

    public $sortDirection = false;

    public $nameRelashion;

    public function orderColumBy(string $columValue): void
    {
        if ($this->columName === $columValue) {
            $this->sortDirection = ! $this->sortDirection;
        } else {
            $this->sortDirection = true;
        }
        $this->columName = $columValue;
    }

    public function makeQueryByColumn($query)
    {
        return $this->getQueryValues() === null ? $query : $this->buildQuery($query);

    }

    protected function getQueryValues(): ?string
    {
        if (empty($this->columName)) {
            return null;
        }

        return $this->columName;

    }

    public function buildQuery($query)
    {
        return $query->orderBy($this->getQueryValues(), $this->sortDirection ? 'asc' : 'desc');
    }

    public function makeQueryBySearch(string $stringvalue, $query)
    {
        $stringvalue = ucfirst(strtolower($stringvalue));

        if (Str::contains($this->filtervalue, '_id')) {

            return $query->{$this->nameRelashion}($stringvalue, $this->filtervalue);

        }

        return $query->where($this->filtervalue, 'like', '%'.$stringvalue.'%')
            ->orderBy($this->filtervalue, $this->sortDirection ? 'asc' : 'desc');

    }

    public function inicializteTableSorting($modelName): void
    {
        $model = "\\App\\Models\\$modelName";

        $this->resetPage();
        $this->resetOrdersValues();
        $this->filtervalue = $model::$startFilterBay;
    }

    private function resetOrdersValues(): void
    {
        $this->columName = null;
        $this->sortDirection = false;
        $this->sortField = null;
    }
}
