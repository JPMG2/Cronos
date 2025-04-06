<?php

declare(strict_types=1);

/**
 * Trait TableSorting
 *
 * Provides utility methods to handle table sorting and query building functionality
 * for database interactions within a Laravel application, including ordering and
 * searching capabilities by specific columns.
 */

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
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

    public $listFilterValues;

    /**
     * Orders the query results by the specified column.
     *
     * This method toggles the sort direction if the column is already being sorted,
     * otherwise, it sets the sort direction to ascending. It then sets the column name
     * to be used for ordering the query results.
     *
     * @param  string  $columValue  The name of the column to order by.
     */
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

    /**
     * Builds the query with ordering based on the current column and sort direction.
     *
     * This method orders the query results by the column name retrieved from `getQueryValues()`
     * and the current sort direction. The sort direction is determined by the `sortDirection` property.
     *
     * @param  Builder  $query  The query builder instance.
     * @return Builder The modified query builder instance.
     */
    public function buildQuery($query)
    {
        return $query->orderBy($this->getQueryValues(), $this->sortDirection ? 'asc' : 'desc');
    }

    /**
     * Filters the query results based on the provided search value.
     *
     * This method modifies the query to filter results based on the specified search value.
     * If the filter value contains '_id', it calls a relationship method to handle the query.
     * Otherwise, it applies a 'like' filter to the query and orders the results.
     *
     * @param  string  $stringvalue  The value to search for.
     * @param  Builder  $query  The query builder instance.
     * @return Builder The modified query builder instance.
     */
    public function makeQueryBySearch(string $stringvalue, $query)
    {
        $stringvalue = mb_strtolower(trim($stringvalue));

        if (Str::contains($this->filtervalue, '_id')) {

            return $query->{$this->nameRelashion}($stringvalue, $this->filtervalue);

        }

        return $query->whereRaw('LOWER('.$this->filtervalue.') like ?', ['%'.$stringvalue.'%'])
            ->orderBy($this->filtervalue, $this->sortDirection ? 'asc' : 'desc');

    }

    /**
     * Initializes table sorting for the specified model.
     *
     * This method sets up the initial state for table sorting by resetting the page,
     * resetting order values, and setting the filter value based on the model's starting filter.
     *
     * @param  string  $modelName  The name of the model to initialize table sorting for.
     */
    public function inicializteTableSorting(string $modelName): void
    {
        $model = "\\App\\Models\\$modelName";

        $this->resetPage();
        $this->resetOrdersValues();
        $this->filtervalue = $model::$startFilterBay;
        $this->listFilterValues = $model::getFilterableAttributes();
    }

    /**
     * Retrieves the current column name used for sorting.
     *
     * This method returns the column name that is currently set for sorting.
     * If the column name is not set, it returns null.
     *
     * @return string|null The column name used for sorting, or null if not set.
     */
    protected function getQueryValues(): ?string
    {
        if (empty($this->columName)) {
            return null;
        }

        return $this->columName;
    }

    /**
     * Resets the order values to their default state.
     *
     * This method sets the column name, sort direction, and sort field to their default values.
     * It is typically used to clear any existing sorting configurations.
     */
    private function resetOrdersValues(): void
    {
        $this->columName = null;
        $this->sortDirection = false;
        $this->sortField = null;
    }
}
