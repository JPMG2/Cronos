<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

use App\Traits\UtilityForm;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class ModelsQuerys
{
    use UtilityForm;

    protected string $modelName;

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->modelName = class_basename($this->model);

    }

    final public function store(array $data): Model
    {
        return $this->model->create($this->getValuesModel($data, $this->modelName));

    }

    final public function update(array $data, int $id): Model
    {
        $model = $this->model->findOrFail($id);
        $model->update($this->getValuesModel($data, $this->modelName));

        return $model;
    }

    final public function show(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    final public function showWithRelationship(int $id, string $relationName): ?Model
    {
        return $this->model->showData($id, $relationName);
    }

    final public function addWithRelastionship(int $id, array $data, string $relationName): array
    {
        return $this->model->findOrFail($id)->saveRelation($data, $relationName);
    }

    final public function createAndAssociate(array $parentModel, array $childModel, string $relationName): ?Model
    {
        $newInstance = null;
        try {
            DB::transaction(function () use ($parentModel, $childModel, $relationName, &$newInstance) {

                $newInstance = $this->store($parentModel);

                $newInstance->saveRelation($childModel, $relationName);

            });
        } catch (Exception $e) {
            abort(500, 'Error en el registro a Base de Datos.', ['Contacta al administrador del sistema.']);
        }

        return $newInstance;
    }

    final public function updateAndAssociate(int $idParent, array $parentModel, array $childModel, string $relationName) {}
}
