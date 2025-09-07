<?php

declare(strict_types=1);

namespace App\Classes\Registro;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

final class DepaValidation
{
    public function onDepartmentCreate(array $dept)
    {

        return Validator::make(

            $this->inicialiciteAtributes($dept),
            [
                'department_name' => AttributeValidator::uniqueIdNameLength(3, 'departments', 'department_name', null),
                'department_code' => AttributeValidator::uniqueIdNameLength(3, 'departments', 'department_code', null),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }

    public function inicialiciteAtributes($dept)
    {

        return [
            'department_name' => ucwords(mb_strtolower(mb_trim($dept['department_name']))),
            'department_code' => mb_strtoupper(mb_trim($dept['department_code'])),
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

                'department_name' => AttributeValidator::uniqueIdNameLength(3, 'departments', 'department_name', $id),
                'department_code' => AttributeValidator::uniqueIdNameLength(3, 'departments', 'department_code', $id),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }
}
