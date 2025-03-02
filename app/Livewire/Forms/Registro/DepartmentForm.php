<?php

namespace App\Livewire\Forms\Registro;

use App\Classes\Registro\DepaValidation;
use App\Classes\Services\ModelService;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\Department;
use Livewire\Form;

class DepartmentForm extends Form
{
    public array $datadeparment = [
        'department_name' => '',
        'department_code' => '',

    ];

    public function departmentStore(DepaValidation $depValidation): array
    {
        $services = $this->iniService();

        return NotifyQuerys::msgCreate($services->store($depValidation->onDepartmentCreate($this->datadeparment)));
    }

    public function departmentUpdate(DepaValidation $depValidation, $modelDepartment): array
    {
        $services = $this->iniService();

        return NotifyQuerys::msgUpadte($services->update($depValidation->onDepartmentUpdate($this->datadeparment, $modelDepartment->id), $modelDepartment->id));
    }

    protected function iniService()
    {
        return new ModelService(new Department);
    }
}
