<?php

namespace App\Classes\Gestion;

use App\Models\InsuranceType;
use App\Traits\UtilityForm;

class InsuranceTypeObj
{
    use UtilityForm;

    public function store(array $arrayInsuranceType): InsuranceType
    {
        return InsuranceType::create($this->getValuesModel($arrayInsuranceType, 'InsuranceType'));
    }
}
