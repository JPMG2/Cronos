<?php

declare(strict_types=1);

namespace App\Classes\Personal;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

final class EspecialistValidation
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
                    AttributeValidator::medicalCredential((int) $especialsit['credential_id'], $especialsit['medical_codenumber'], null),
                ],
                'specialty_id' => 'sometimes',
                'state_id' => 'required',
                'medical_email' => AttributeValidator::emailValid('medicals', 'medical_email', null),
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
            'state_id' => trim((string) $especialsit['state_id']),
            'credential_id' => trim((string) $especialsit['credential_id']),
            'specialty_id' => trim((string) $especialsit['specialty_id']),
            'degree_id' => trim((string) $especialsit['degree_id']),
            'medical_name' => ucwords(mb_strtolower(trim($especialsit['medical_name']))),
            'medical_lastname' => ucwords(mb_strtolower(trim($especialsit['medical_lastname']))),
            'medical_address' => trim($especialsit['medical_address']),
            'medical_phone' => trim($especialsit['medical_phone']),
            'medical_email' => mb_strtolower(trim($especialsit['medical_email'])),
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

    public function onEspecialistUpdate(array $especialsit)
    {

        return Validator::make(

            $this->inicialiciteAtributes($especialsit),
            [
                'degree_id' => 'required',
                'medical_name' => AttributeValidator::stringValid(true, 3),
                'medical_lastname' => AttributeValidator::stringValid(true, 3),
                'medical_dni' => AttributeValidator::uniqueIdNameLength(5, 'medicals', 'medical_dni', (int) $especialsit['id']),
                'credential_id' => 'required',
                'medical_codenumber' => ['bail', 'required',
                    AttributeValidator::medicalCredential((int) $especialsit['credential_id'], $especialsit['medical_codenumber'], (int) $especialsit['id']),
                ],
                'specialty_id' => 'sometimes',
                'state_id' => 'required',
                'medical_email' => AttributeValidator::emailValidById((int) $especialsit['id'], 'medicals', 'medical_email'),
                'medical_phone' => AttributeValidator::digitValid(5, false),
                'medical_address' => AttributeValidator::stringValid(false, 5),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }
}
