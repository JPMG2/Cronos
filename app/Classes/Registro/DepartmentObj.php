<?php

namespace App\Classes\Registro;

use App\Models\Department;
use App\Traits\UtilityForm;

class DepartmentObj
{
    use UtilityForm;

    protected $modelName = 'Department';

    public function store($arrayDepartment): Department
    {

        return Department::create($this->getValuesModel($arrayDepartment, $this->modelName));

    }

    public function update($arrayDepartment, Department $department): Department
    {
        $department->update($this->getValuesModel($arrayDepartment, $this->modelName));

        return $department;
    }
}
