<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait UtilityForm
{
    public string $isdisabled = '';

    public bool $isupdate = false;

    public function cleanFormValues()
    {

        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function getValuesModel(array $arrayvalues, $modelName): array
    {
        return prepareData($arrayvalues, $this->getObjetProperties($modelName));
    }

    public function getObjetProperties($classname): array
    {
        $model = 'App\\Models\\'.$classname;

        return App::make($model)->getFillable();

    }

    public function editActivate()
    {
        $this->isdisabled = '';
        $this->isupdate = true;
    }
}
