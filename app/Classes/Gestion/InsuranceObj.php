<?php

namespace App\Classes\Gestion;

use App\Models\Insurance;
use App\Traits\UtilityForm;

class InsuranceObj
{
    use UtilityForm;

    protected $modelName = 'Insurance';

    public function store(array $arrayInsurance): Insurance
    {
        return Insurance::create($this->getValuesModel($arrayInsurance, $this->modelName));
    }
}
