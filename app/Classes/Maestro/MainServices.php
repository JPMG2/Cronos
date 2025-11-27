<?php

declare(strict_types=1);

namespace App\Classes\Maestro;

use App\Models\Service;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

final class MainServices extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Service());
    }

    public function showServiceInfo(int $id): Model
    {
        return $this->model->with($this->model->getRelationModel())->findOrFail($id);
    }
}
