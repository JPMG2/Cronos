<?php

namespace App\Classes\Services;

use App\Classes\Utilities\ModelsQuerys;
use Illuminate\Database\Eloquent\Model;

class ModelService extends ModelsQuerys
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}
