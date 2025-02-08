<?php

namespace App\Classes\Personal;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

class EspecialistValidation
{
    public function onEspecialistCreate(array $especialsit)
    {

        return Validator::make(

            $this->inicialiciteAtributes($especialsit),
            [
                'degree_id' => 'required',
                'medical_name' => AttributeValidator::stringValid(true, 3),
                'medical_lastname' => AttributeValidator::stringValid(true, 3),
                'medical_dni' => AttributeValidator::uniqueIdNameLength(5, 'medicals', 'medical_dni', null),
                'credential_id' => 'required',
                'medical_codenumber' => ['bail', 'required',
                    AttributeValidator::medicalCredential((int) $especialsit['credential_id'], $especialsit['medical_codenumber']),
                ],
                'specialty_id' => 'sometimes',
                'state_id' => 'required',
                'medical_email' => AttributeValidator::emailValid(false),
                'medical_phone' => AttributeValidator::digitValid(5, false),
                'medical_address' => AttributeValidator::stringValid(false, 5),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }

    public function inicialiciteAtributes($especialsit)
    {

        return [
            'state_id' => trim($especialsit['state_id']),
            'credential_id' => trim($especialsit['credential_id']),
            'specialty_id' => trim($especialsit['specialty_id']),
            'degree_id' => trim($especialsit['degree_id']),
            'medical_name' => ucwords(strtolower(trim($especialsit['medical_name']))),
            'medical_lastname' => ucwords(strtolower(trim($especialsit['medical_lastname']))),
            'medical_address' => trim($especialsit['medical_address']),
            'medical_phone' => trim($especialsit['medical_phone']),
            'medical_email' => strtolower(trim($especialsit['medical_email'])),
            'medical_dni' => trim($especialsit['medical_dni']),
            'medical_codenumber' => trim($especialsit['medical_codenumber']),
        ];

    }

    public function niceNames(): array
    {
        return [
            'state_id' => config('nicename.status'),
            'credential_id' => config('nicename.matricula'),
            'specialty_id' => config('nicename.especialist'),
            'degree_id' => config('nicename.titulo'),
            'medical_name' => config('nicename.name'),
            'medical_lastname' => config('nicename.apellido'),
            'medical_address' => config('nicename.direccion'),
            'medical_phone' => config('nicename.telefono'),
            'medical_email' => config('nicename.correo'),
            'medical_dni' => config('nicename.dni'),
            'medical_codenumber' => config('nicename.codigomedico'),
        ];
    }

    public function onEspecialistUpdate(array $branch)
    {

        return Validator::make(

            $this->inicialiciteAtributes($branch),
            [

                'company_id' => 'required',
                'province_id' => AttributeValidator::mayorValid(),
                'city_id' => AttributeValidator::mayorValid(),
                'state_id' => AttributeValidator::mayorValid(),
                'branch_name' => AttributeValidator::uniqueIdNameLength(3, 'branches', 'branch_name', $branch['id']),
                'branch_code' => AttributeValidator::uniqueIdNameLength(3, 'branches', 'branch_code', $branch['id']),
                'branch_address' => AttributeValidator::stringValid(true, 5),
                'branch_phone' => AttributeValidator::digitValid(5, true),
                'branch_zipcode' => AttributeValidator::stringValid(true, 3),
                'branch_email' => AttributeValidator::uniqueEmail('branches', 'branch_email', $branch['id']),
                'branch_web' => AttributeValidator::webValid(false),
                'branch_person_contact' => AttributeValidator::stringValid(true, 5),
                'branch_person_phone' => AttributeValidator::digitValid(5, true),
                'branch_person_email' => AttributeValidator::uniqueEmail('branches', 'branch_person_email', $branch['id']),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }
}
