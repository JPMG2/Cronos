<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Traits\UtilityForm;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    use UtilityForm;

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    final public function find(int $id): ?Model
    {
        return $this->model->query()->find($id);
    }

    final public function showOne(int $id): ?Model
    {
        return $this->findOrFail($id);
    }

    final public function findOrFail(int $id): Model
    {
        return $this->model->query()->findOrFail($id);
    }

    final public function create(array $data): Model
    {
        return $this->model->query()->create($this->getValuesModel($data, $this->model));
    }

    final public function update(int $id, array $data): Model
    {
        $model = $this->findOrFail($id);
        $model->update($this->getValuesModel($data, $this->model));

        return $model;
    }

    final public function delete(int $id): bool
    {
        return (bool) $this->findOrFail($id)->delete();
    }

    final public function withRelation(): array
    {
        return $this->model->getRelationModel();
    }
}
