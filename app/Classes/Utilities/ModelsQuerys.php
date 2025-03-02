<?php

namespace App\Classes\Utilities;

use App\Traits\UtilityForm;
use Illuminate\Database\Eloquent\Model;

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

    public function store(array $data): Model
    {
        return $this->model->create($this->getValuesModel($data, $this->modelName));

    }

    public function update(array $data, int $id): Model
    {
        $model = $this->model->findOrFail($id);
        $model->update($this->getValuesModel($data, $this->modelName));

        return $model;
    }

    public function show(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function showWithRelationship(int $id): ?Model
    {
        return $this->model->showData($id);
    }
}
