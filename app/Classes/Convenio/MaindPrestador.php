<?php

declare(strict_types=1);

namespace App\Classes\Convenio;

use App\Repositories\BaseRepository;

final class MaindPrestador extends BaseRepository
{
    public function showProvedorInfo($id)
    {
        return $this->model->with('insuranceType', 'state', 'city.province')->findOrFail($id);
    }
}
