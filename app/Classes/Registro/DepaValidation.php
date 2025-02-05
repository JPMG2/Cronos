<?php

namespace App\Classes\Registro;

use Illuminate\Support\Facades\Validator;

class DepaValidation
{
    public function onDepartmentCreate(array $dept)
    {

        return Validator::make(

            $this->inicialiciteAtributes($dept),
            [
                'department_name' => config('validaterules.name_unique_reuired_min')(3, 'departments',
                    'department_name'),
                'department_code' => config('validaterules.name_unique_reuired_min')(3, 'departments',
                    'department_code'),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }

    public function inicialiciteAtributes($dept)
    {

        return [
            'department_name' => ucwords(strtolower(trim($dept['department_name']))),
            'department_code' => strtoupper(trim($dept['department_code'])),
        ];

    }

    public function niceNames(): array
    {
        return [
            'department_name' => config('nicename.departamento'),
            'department_code' => config('nicename.codigo'),
        ];
    }

    public function onDepartmentUpdate(array $dept, $id)
    {

        return Validator::make(

            $this->inicialiciteAtributes($dept),
            [
                'department_name' => config('validaterules.name_unique_reuired_min')(3, 'departments', 'department_name', $id),
                'department_code' => config('validaterules.name_unique_reuired_min')(3, 'departments', 'department_code', $id),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }
}
