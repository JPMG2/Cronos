<?php

declare(strict_types=1);

namespace App\Action\Patient;

use App\Models\Patient;
use App\Traits\UtilityForm;

final class UpdatePatiente
{
    use UtilityForm;

    public function handle(array $patientData, $personModel): Patient
    {

        return $personModel->patiente()->updateOrCreate(
            ['person_id' => $personModel->id],
            $this->getValuesModel($patientData, new Patient())
        );
    }
}
