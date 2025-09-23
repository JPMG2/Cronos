<?php

declare(strict_types=1);

/**
 * Trait TableFilter
 *
 * Provides reusable functions to filter query results based on related model attributes.
 * Implements dynamic filtering utilizing the `whereHas` query method to apply search constraints
 * on relationships and enables eager loading of associated relations.
 *
 * Methods use similar structures to ensure consistency across filtering operations.
 */

namespace App\Traits\DbTraits;

use Illuminate\Database\Eloquent\Builder;

trait TableFilter
{
    /**
     * Filters the query results based on the state name of a related model.
     *
     * This method applies a `whereHas` constraint to the query, filtering the results
     * based on the `state_name` attribute of the related model. It also enables eager loading
     * of the specified relations.
     *
     * @param  Builder $query         The query builder instance.
     * @param  string  $relationName  The name of the relation to apply the filter on.
     * @param  string  $searchvalue   The value to search for in the `state_name` attribute.
     * @param  array   $withRelations The relations to eager load.
     * @return Builder The modified query builder instance.
     */
    private function state_id($query, string $relationName, string $searchvalue, array $withRelations)
    {
        return $this->applyFilter($query, $relationName, 'state_name', $searchvalue, $withRelations);
    }

    private function applyFilter(Builder $query, string $relationName, string $columnName, string $searchValue, array $withRelations, string $table): Builder
    {
        return $searchValue === '' || $searchValue === '0' ? $query->whereHas($relationName)
            ->join($table, 'medicals.person_id', '=', $table.'.id')
            ->orderBy($table.'.'.$columnName, 'asc')->with($withRelations)
            :
        $query->whereHas(
            $relationName,
            function ($query) use ($columnName, $searchValue): void {
                $query->whereRaw('LOWER('.$columnName.') like ?', ['%'.$searchValue.'%'])
                    ->orderBy($columnName, 'desc');
            }
        )->with($withRelations);
    }

    private function person_name($query, string $relationName, string $searchvalue, array $withRelations)
    {
        return $this->applyFilter($query, $relationName, 'person_name', $searchvalue, $withRelations, 'people');
    }

    private function person_lastname($query, string $relationName, string $searchvalue, array $withRelations)
    {
        return $this->applyFilter($query, $relationName, 'person_lastname', $searchvalue, $withRelations);
    }

    /**
     * Filters the query results based on the specialty name of a related model.
     *
     * This method applies a `whereHas` constraint to the query, filtering the results
     * based on the `specialty_name` attribute of the related model. It also enables eager loading
     * of the specified relations.
     *
     * @param  Builder $query         The query builder instance.
     * @param  string  $relationName  The name of the relation to apply the filter on.
     * @param  string  $searchvalue   The value to search for in the `specialty_name` attribute.
     * @param  array   $withRelations The relations to eager load.
     * @return Builder The modified query builder instance.
     */
    private function specialty_id($query, string $relationName, string $searchvalue, array $withRelations)
    {
        return $this->applyFilter($query, $relationName, 'specialty_name', $searchvalue, $withRelations);

    }

    /**
     * Filters the query results based on the credential number of a related model.
     *
     * This method applies a `whereHas` constraint to the query, filtering the results
     * based on the `credential_number` attribute of the related model. It also enables eager loading
     * of the specified relations.
     *
     * @param  Builder $query         The query builder instance.
     * @param  string  $relationName  The name of the relation to apply the filter on.
     * @param  string  $searchvalue   The value to search for in the `credential_number` attribute.
     * @param  array   $withRelations The relations to eager load.
     * @return Builder The modified query builder instance.
     */
    private function credential_id($query, string $relationName, string $searchvalue, array $withRelations)
    {
        return $this->applyFilter($query, $relationName, 'credential_number', $searchvalue, $withRelations);
    }

    private function insurance_type_id($query, string $relationName, string $searchvalue, array $withRelations)
    {
        return $this->applyFilter($query, $relationName, 'insuratype_name', $searchvalue, $withRelations);
    }

    private function nationality_id($query, string $relationName, string $searchvalue, array $withRelations)
    {
        return $this->applyFilter($query, $relationName, 'nationality_name', $searchvalue, $withRelations);
    }

    private function occupation_id($query, string $relationName, string $searchvalue, array $withRelations)
    {
        return $this->applyFilter($query, $relationName, 'occupation_name', $searchvalue, $withRelations);
    }
}
