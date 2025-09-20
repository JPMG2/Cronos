<?php

declare(strict_types=1);

namespace App\Traits;

use App\Classes\Utilities\NotifyQuerys;

trait UtilityForm
{
    public string $isdisabled = '';

    public bool $isupdate = false;

    public function cleanFormValues(): void
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
        return $classname->getFillable();

    }

    public function editActivate(): void
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
