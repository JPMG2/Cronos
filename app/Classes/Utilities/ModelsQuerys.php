<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

use App\Traits\UtilityForm;
use BadMethodCallException;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class ModelsQuerys
{
    use UtilityForm;

    protected string $modelName;

    protected Model $model;

    /**
     * Initialize the query service with a model instance
     *
     * @param  Model  $model  The model instance to work with
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->modelName = class_basename($this->model);
    }

    /**
     * Find a model by its primary key
     *
     * @param  int  $id  The primary key value
     * @return Model The found model instance
     *
     * @throws ModelNotFoundException If model not found
     */
    final public function show(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find a model with a specific relationship loaded
     *
     * @param  int  $id  The primary key value
     * @param  string  $relationName  The name of the relationship to load
     * @return Model|null The model with relationship or null if not found
     */
    final public function showWithRelationship(int $id, string $relationName): ?Model
    {
        if (method_exists($this->model, 'showData')) {
            return $this->model->showData($id, $relationName);
        }

        return $this->model->with($relationName)->findOrFail($id);
    }

    /**
     * Add related data to an existing model
     *
     * @param  int  $id  The primary key of the parent model
     * @param  array  $data  The data for the related model
     * @param  string  $relationName  The name of the relationship
     * @return array|Model The result of the saveRelation operation
     *
     * @throws ModelNotFoundException If parent model not found
     */
    final public function addWithRelationship(int $id, array $data, string $relationName)
    {
        $parentModel = $this->model->findOrFail($id);

        if (! method_exists($parentModel, 'saveRelation')) {
            throw new BadMethodCallException("Metodo saveRelation no existe en el modelo {$this->modelName}");
        }

        return $this->model->findOrFail($id)->saveRelation($data, $relationName);
    }

    /**
     * Create a parent model and associate child data in a single transaction
     *
     * @param  array  $parentArray  Data for the parent model
     * @param  array  $childArray  Data for the child/related model
     * @param  string  $relationName  Name of the relationship
     * @return Model|null The created parent model or null if transaction failed
     */
    final public function createAndAssociate(array $parentArray, array $childArray, string $relationName): ?Model
    {
        return $this->executeWithTransaction(
            function () use ($parentArray) {
                return $this->store($parentArray);
            },
            $childArray,
            $relationName,
            'saveRelation',
            'Error en el registro a Base de Datos.'
        );
    }

    /**
     * Create a new model instance with the given data
     *
     * @param  array  $data  The data to create the model with
     * @return Model The created model instance
     */
    final public function store(array $data): Model
    {
        return $this->model->create($this->getValuesModel($data, $this->model));
    }

    /**
     * Update a parent model and its related data in a single transaction
     *
     * @param  int  $idParent  The ID of the parent model to update
     * @param  array  $parentArray  Data for updating the parent model
     * @param  array  $childArray  Data for updating the related model
     * @param  string  $relationName  Name of the relationship
     * @return Model|null The updated parent model or null if transaction failed
     */
    final public function updateAndAssociate(int $idParent, array $parentArray, array $childArray, string $relationName): ?Model
    {
        return $this->executeWithTransaction(
            function () use ($parentArray, $idParent) {
                return $this->update($parentArray, $idParent);
            },
            $childArray,
            $relationName,
            'updateRelation',
            'Error en la actualización a Base de Datos.'
        );
    }

    /**
     * Update an existing model with the given data
     *
     * @param  array  $data  The data to update the model with
     * @param  int  $id  The ID of the model to update
     * @return Model The updated model instance
     *
     * @throws ModelNotFoundException If model not found
     */
    final public function update(array $data, int $id): Model
    {
        $model = $this->model->findOrFail($id);

        $model->update($this->getValuesModel($data, $this->model));

        return $model;
    }

    /**
     * Execute database operations within a transaction
     *
     * @param  callable  $modelOperation  Function that returns a model instance
     * @param  array  $childArray  Data for the relation
     * @param  string  $relationName  Name of the relation method
     * @param  string  $relationMethod  Method to call on the model for the relation
     * @param  string  $errorMessage  Message to show on error
     * @return Model|null The model instance or null if transaction failed
     */
    protected function executeWithTransaction(
        callable $modelOperation,
        array $childArray,
        string $relationName,
        string $relationMethod,
        string $errorMessage
    ): ?Model {
        $instance = null;
        try {
            DB::transaction(
                function () use ($modelOperation, $childArray, $relationName, $relationMethod, &$instance) {
                    $instance = $modelOperation();
                    $this->checkMethodExist($instance, $relationName);
                    $instance->$relationMethod($childArray, $relationName);
                }
            );
        } catch (Exception $e) {
            // Log the actual exception for debugging purposes
            Log::error(
                "Transaction error: {$e->getMessage()}",
                [
                    'exception' => $e,
                    'model' => $this->modelName,
                    'relation' => $relationName,
                ]
            );
            $this->handleError($errorMessage);
        }

        return $instance;
    }

    /**
     * Check if a method exists on a model instance
     *
     * @param  Model  $modelInstance  The model instance to check
     * @param  string  $method  The method name to check for
     * @return bool True if the method exists, false otherwise
     *
     * @throws HttpException If method doesn't exist
     */
    protected function checkMethodExist(Model $modelInstance, string $method): bool
    {
        if (method_exists($modelInstance, $method)) {
            return true;
        }

        $this->handleError('Error el método '.$method.' en el modelo '.$this->modelName.' no existe!!');

        return false;
    }

    /**
     * Handle errors by aborting the request with a 500 status code
     *
     * @param  string  $message  The error message
     *
     * @throws HttpException
     */
    protected function handleError(string $message): void
    {
        abort(500, $message, ['Contacta al administrador del sistema.']);
    }
}
