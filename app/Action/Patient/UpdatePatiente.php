<?php

declare(strict_types=1);

namespace App\Action\Patient;

use App\Models\Patient;
use App\Traits\UtilityForm;

final class UpdatePatiente
{
    use UtilityForm;

    protected string $modelName;

    public function handle(array $patientData, $personModel): Patient
    {
        $this->modelName = 'Patient';

        return $personModel->patiente()->updateOrCreate(
            ['person_id' => $personModel->id],
            $this->getValuesModel($patientData, $this->modelName));
    }
}
