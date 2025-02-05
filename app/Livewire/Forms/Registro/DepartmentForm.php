<?php

namespace App\Livewire\Forms\Registro;

use App\Classes\Registro\DepartmentObj;
use App\Classes\Registro\DepaValidation;
use App\Classes\Utilities\NotifyQuerys;
use Livewire\Form;

class DepartmentForm extends Form
{
    public array $datadeparment = [
        'department_name' => '',
        'department_code' => '',

    ];

    public function departmentStore(DepaValidation $depValidation, DepartmentObj $depObj): array
    {

        return NotifyQuerys::msgCreate($depObj->store($depValidation->onDepartmentCreate($this->datadeparment)));
    }

    public function departmentUpdate(DepaValidation $depValidation, DepartmentObj $depObj, $modelDepartment): array
    {
        return NotifyQuerys::msgUpadte($depObj->update($depValidation->onDepartmentUpdate($this->datadeparment, $modelDepartment->id), $modelDepartment));
    }
}
