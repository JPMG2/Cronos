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

    public function update(array $arrayInsurance): Insurance
    {
        $insurance = Insurance::findOrFail($arrayInsurance['id']);
        $insurance->update($this->getValuesModel($arrayInsurance, $this->modelName));

        return $insurance;
    }

    public function show(int $idInsurance): Insurance
    {
        return Insurance::findOrFail($idInsurance);
    }
}
