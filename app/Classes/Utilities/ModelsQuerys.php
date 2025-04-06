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

    protected $modelName;

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

    final public function show(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    final public function showWithRelationship(int $id): ?Model
    {
        return $this->model->showData($id);
    }

    final public function addWithRelastionship(int $id, array $data, string $namerelation): array
    {
        $mainModel = $this->model->findOrFail($id);

        return $mainModel->saveRelation($data, $namerelation);
    }

    final public function storeRelastionship(array $parentModel, array $chilModel, string $namerelation): ?Model
    {
        $newInstance = null;
        try {
            DB::transaction(function () use ($parentModel, $chilModel, $namerelation, &$newInstance) {

                $newInstance = $this->store($parentModel);

                $newInstance->saveRelation($chilModel, $namerelation);

            });
        } catch (Exception $e) {
            abort(500, 'Error en el registro a Base de Datos.', ['Contacta al administrador del sistema.']);
        }

        return $newInstance;
    }
}
