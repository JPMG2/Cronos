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

/**
 * Trait TableSorting
 * Provides functionalities to handle table sorting and filtering in a structured manner.
 */
trait TableSorting
{
    public ?string $sortField = null;

    public mixed $filterValue = null;

    public bool $sortDirection = true;

    public $nameRelashion;

    public $modelName;

    /**
     * Orders the query results by the specified column.
     *
     * This method toggles the sort direction if the column is already being sorted,
     * otherwise, it sets the sort direction to ascending. It then sets the column name
     * to be used for ordering the query results.
     *
     * @param string $columValue The name of the column to order by.
     */
    public function orderColumBy(string $column): void
    {
        if ($this->sortField === $column) {
            $this->sortDirection = ! $this->sortDirection;
        } else {
            $this->sortField = $column;
            $this->sortDirection = true; // default ASC on new column
        }
    }

    /**
     * Initializes table sorting for the specified model.
     *
     * This method sets up the initial state for table sorting by resetting the page,
     * resetting order values, and setting the filter value based on the model's starting filter.
     *
     * @param string $modelName The name of the model to initialize table sorting for.
     */
    public function setupTableSorting(string $modelName): void
    {
        $this->modelName = "\\App\\Models\\{$modelName}";
        $this->resetPage();
        $this->resetOrdersValues();
        $this->filterValue = $this->getModelDefaultFilter($modelName);
    }

    /**
     * Resets the order values to their default state.
     *
     * This method sets the column name, sort direction, and sort field to their default values.
     * It is typically used to clear any existing sorting configurations.
     */
    private function resetOrdersValues(): void
    {
        $this->sortDirection = true;
        $this->sortField = null;
    }

    /**
     * Gets the default filter field for a model.
     * First tries to get from config, then falls back to interface method.
     *
     * @param  string $modelName The name of the model.
     * @return string The default filter field.
     */
    private function getModelDefaultFilter(string $modelName): string
    {
        $defaultFilter = config("model_filters.default_filters.{$modelName}");

        if ($defaultFilter) {
            return $defaultFilter;
        }

        // Fallback to interface method if model implements Filterable
        $modelClass = "\\App\\Models\\{$modelName}";
        if (method_exists($modelClass, 'getDefaultFilterField')) {
            return $modelClass::getDefaultFilterField();
        }

        // Ultimate fallback
        return 'id';
    }
}
