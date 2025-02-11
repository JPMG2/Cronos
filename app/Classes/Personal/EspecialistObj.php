<?php

namespace App\Classes\Personal;

use App\Models\Credential;
use App\Models\Medical;
use App\Traits\UtilityForm;

class EspecialistObj
{
    use UtilityForm;

    protected $modelName = 'Medical';

    public function store(array $arrayEspecialist): Medical
    {

        $medical = Medical::create($this->getValuesModel($arrayEspecialist, $this->modelName));

        $credentials = Credential::find($arrayEspecialist['credential_id']);

        if ($credentials) {
            $medical->credentials()->attach($credentials->id, ['credential_number' => $arrayEspecialist['medical_codenumber']]);
        }

        return $medical;
    }

    public function update(array $arrayEspeciaist, int $spcialistId): Medical
    {
        $medical = Medical::find($spcialistId);

        $medical->update($this->getValuesModel($arrayEspeciaist, $this->modelName));

        $medical->credentials()->updateExistingPivot($arrayEspeciaist['credential_id'], ['credential_number' => $arrayEspeciaist['medical_codenumber']]);

        return $medical;
    }

    public function show($medicalId)
    {
        return Medical::listMedicals()->find($medicalId);

    }
}
