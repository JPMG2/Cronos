<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface for models that support advanced relationship operations
 * with the ModelsQuerys utility class.
 */
interface ModelsQuerysCompatible
{
    /**
     * Save related data to this model instance
     *
     * @param  array  $data  The data for the related model
     * @param  string  $relationName  The name of the relationship method
     * @return mixed The result of the save operation
     */
    public function saveRelation(array $data, string $relationName): mixed;

    /**
     * Update related data for this model instance
     *
     * @param  array  $data  The data to update the related model with
     * @param  string  $relationName  The name of the relationship method
     * @return mixed The result of the update operation
     */
    public function updateRelation(array $data, string $relationName): mixed;

    /**
     * Show this model with a specific relationship loaded
     *
     * @param  int  $id  The primary key value
     * @param  string  $relationName  The name of the relationship to load
     * @return Model|null The model with relationship loaded or null if not found
     */
    public function showData(int $id, string $relationName): ?Model;
}