<?php

declare(strict_types=1);

namespace App\Classes\MainPerson;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

final class PersonValidation
{
    public function onPersonCreate(array $person)
    {

        return Validator::make(

            $this->inicialiciteAtributes($person),
            [
                'person_name' => AttributeValidator::stringValid(true, 4),
                'person_lastname' => AttributeValidator::stringValid(true, 4),
                'gender_id' => 'sometimes|exists:genders,id',
                'person_datebirth' => AttributeValidator::dateValid(true),
                'marital_status_id' => 'sometimes|exists:marital_statuses,id',
                'occupation_id' => 'sometimes|exists:occupations,id',
                'person_phone' => AttributeValidator::digitValid(5, false),
                'person_email' => AttributeValidator::emailValid('people', 'person_email', null),
                'nationality_id' => 'sometimes|exists:nationalities,id',
                'person_address' => AttributeValidator::stringValid(false, 5),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }

    public function onPersonUpdate(array $person, int $id)
    {
        return Validator::make(

            $this->inicialiciteAtributes($person),
            [
                'person_name' => AttributeValidator::stringValid(true, 4),
                'person_lastname' => AttributeValidator::stringValid(true, 4),
                'gender_id' => 'sometimes|exists:genders,id',
                'person_datebirth' => AttributeValidator::dateValid(true),
                'marital_status_id' => 'sometimes|exists:marital_statuses,id',
                'occupation_id' => 'sometimes|exists:occupations,id',
                'person_phone' => AttributeValidator::digitValid(5, false),
                'person_email' => AttributeValidator::emailValid('people', 'person_email', $id),
                'nationality_id' => 'sometimes|exists:nationalities,id',
                'person_address' => AttributeValidator::stringValid(false, 5),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }

    public function inicialiciteAtributes(array $person): array
    {

        return [
            'person_name' => ucwords(mb_strtolower(trim((string) $person['person_name']))),
            'person_lastname' => ucwords(mb_strtolower(trim((string) $person['person_lastname']))),
            'gender_id' => trim((string) $person['gender_id']),
            'person_datebirth' => trim((string) $person['person_datebirth']),
            'marital_status_id' => trim((string) $person['marital_status_id']),
            'occupation_id' => trim((string) $person['occupation_id']),
            'person_phone' => trim((string) $person['person_phone']),
            'person_email' => mb_strtolower(trim((string) $person['person_email'])),
            'nationality_id' => trim((string) $person['nationality_id']),
            'person_address' => trim((string) $person['person_address']),
        ];

    }

    public function niceNames(): array
    {
        return [
            'person_name' => config('nicename.name'),
            'person_lastname' => config('nicename.apellido'),
            'gender_id' => config('nicename.gender'),
            'person_datebirth' => config('nicename.datebirth'),
            'marital_status_id' => config('nicename.maritalstatus'),
            'occupation_id' => config('nicename.occupation'),
            'person_phone' => config('nicename.telefono'),
            'person_email' => config('nicename.correo'),
            'nationality_id' => config('nicename.nacionalidad'),
            'person_address' => config('nicename.direccion'),
        ];
    }
}
