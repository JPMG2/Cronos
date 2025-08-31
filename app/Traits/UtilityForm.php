<?php

declare(strict_types=1);

namespace App\Traits;

use App\Classes\Utilities\NotifyQuerys;
use Illuminate\Support\Facades\App;

trait UtilityForm
{
    public string $isdisabled = '';

    public bool $isupdate = false;

    public function cleanFormValues()
    {
        $this->isdisabled = '';
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

    public function showToastAndClear($result): void
    {
        $this->dispatch('show-toast', $result);
        $this->clearForm();
    }

    public function showQueryMessage($model, $accion)
    {
        return NotifyQuerys::{$accion}($model);
    }
}
