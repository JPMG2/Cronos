<?php

namespace App\Classes\Registro;

use App\Models\Department;
use App\Traits\UtilityForm;

class DepartmentObj
{
    use UtilityForm;

    protected $modelName = 'Department';

    /**
     * Stores a new department record.
     *
     * This method creates a new department record in the database using the provided data.
     *
     * @param  array  $arrayDepartment  The data for the department.
     * @return Department The created department record.
     */
    public function store($arrayDepartment): Department
    {

        return Department::create($this->getValuesModel($arrayDepartment, $this->modelName));

    }

    /**
     * Updates an existing department record.
     *
     * This method updates the department record with the provided data
     * and returns the updated department instance.
     *
     * @param  array  $arrayDepartment  The data for the department.
     * @param  Department  $department  The department instance to update.
     * @return Department The updated department record.
     */
    public function update($arrayDepartment, Department $department): Department
    {
        $department->update($this->getValuesModel($arrayDepartment, $this->modelName));

        return $department;
    }
}
