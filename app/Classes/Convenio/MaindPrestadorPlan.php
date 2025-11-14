<?php

declare(strict_types=1);

namespace App\Classes\Convenio;

use App\Models\InsurancePlan;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

final class MaindPrestadorPlan extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new InsurancePlan());
    }

    public function showProvedorPlanInfo(int $id): Model
    {
        return $this->model->with($this->model->getRelationModel())->findOrFail($id);
    }
}
