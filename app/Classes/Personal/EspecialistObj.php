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
            $medical->certificates()->attach($credentials->id, ['credential_number' => $arrayEspecialist['medical_codenumber']]);
        }

        return $medical;
    }
}
