<?php

namespace App\Traits;

trait HandleDeleteId
{
    public function deleteModel(mixed $model, ?callable $customValidation = null)
    {
        if ($customValidation && is_callable($customValidation)) {
            $validation = $customValidation($model);
            dd($validation);
        }
    }
}
