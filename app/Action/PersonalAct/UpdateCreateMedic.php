<?php

declare(strict_types=1);

namespace App\Action\PersonalAct;

use App\Models\Medical;
use App\Traits\UtilityForm;

final class UpdateCreateMedic
{
    use UtilityForm;

    public function handle(array $dataMedic, $personModel): Medical
    {

        return $personModel->medical()->updateOrCreate(
            ['person_id' => $personModel->id],
            $this->getValuesModel($dataMedic, new Medical())
        );
    }
}
