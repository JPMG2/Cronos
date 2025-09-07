<?php

declare(strict_types=1);

namespace App\Classes\Patient;

use App\Classes\Utilities\AttributeDocumentValidator;
use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

final class PacienteValidation
{
    public function onCreate(array $arrayPatient): array
    {

        return Validator::make(

            $this->inicialiciteAtributes($arrayPatient),
            [
                'num_document' => [
                    'bail',
                    Rule::prohibitedIf(function () use ($arrayPatient) {
                        return empty($arrayPatient['document_id']) && ! empty($arrayPatient['num_document']);
                    }),
                    AttributeDocumentValidator::documentTypeUnique((int) $arrayPatient['document_id'], $arrayPatient['num_document'], null),
                    AttributeValidator::stringValid(true, 5),
                ],
                'person_name' => AttributeValidator::stringValid(true, 3),
                'person_lastname' => AttributeValidator::stringValid(true, 3),
                'document_id' => AttributeValidator::requireAndExists('documents', 'id', 'document_id'),
                'person_address' => AttributeValidator::stringValid(false, 4),
                'person_phone' => AttributeValidator::stringValid(false, 5),
                'person_datebirth' => AttributeValidator::dateValid(true),
                'person_email' => AttributeValidator::emailValid('people', 'person_email'),
                'province_id' => AttributeValidator::requireAndExists('provinces', 'id', 'province_id'),
                'gender_id' => AttributeValidator::requireAndExists('genders', 'id', 'gender_id'),
                'marital_status_id' => AttributeValidator::requireAndExists('marital_statuses', 'id', 'marital_status_id'),
                'occupation_id' => AttributeValidator::requireAndExists('occupations', 'id', 'occupation_id'),
                'nationality_id' => AttributeValidator::requireAndExists('nationalities', 'id', 'nationality_id'),
                'person_cpcode' => AttributeValidator::stringValid(false, 3),
            ],
            [
                'num_document.prohibited' => 'se requiere tipo de documento.',
            ],
            $this->niceNames()

        )->validate();

    }

    public function inicialiciteAtributes($arrayPatient): array
    {
        return [
            'document_id' => mb_trim((string) $arrayPatient['document_id']),
            'num_document' => mb_trim((string) $arrayPatient['num_document']),
            'person_name' => mb_trim((string) $arrayPatient['person_name']),
            'person_lastname' => mb_trim((string) $arrayPatient['person_lastname']),
            'person_address' => mb_trim((string) $arrayPatient['person_address']),
            'person_phone' => mb_trim((string) $arrayPatient['person_phone']),
            'person_email' => mb_strtolower(mb_trim((string) $arrayPatient['person_email'])),
            'person_datebirth' => mb_trim((string) $arrayPatient['person_datebirth']),
            'nationality_id' => mb_trim((string) $arrayPatient['nationality_id']),
            'gender_id' => mb_trim((string) $arrayPatient['gender_id']),
            'marital_status_id' => mb_trim((string) $arrayPatient['marital_status_id']),
            'occupation_id' => mb_trim((string) $arrayPatient['occupation_id']),
            'person_cpcode' => mb_trim((string) $arrayPatient['person_cpcode']),
            'province_id' => mb_trim((string) $arrayPatient['province_id']),
        ];

    }

    public function niceNames(): array
    {
        return [
            'document_id' => config('nicename.documtype'),
            'person_name' => config('nicename.name'),
            'person_lastname' => config('nicename.apellido'),
            'person_address' => config('nicename.direccion'),
            'person_phone' => config('nicename.telefono'),
            'person_email' => config('nicename.correo'),
            'num_document' => config('nicename.documtnume'),
            'person_datebirth' => config('nicename.datebirth'),
            'nationality_id' => config('nicename.nacionalidad'),
            'gender_id' => config('nicename.gender'),
            'marital_status_id' => config('nicename.maritalstatus'),
            'occupation_id' => config('nicename.occupation'),
            'province_id' => config('nicename.provincia'),
            'person_cpcode' => config('nicename.cp'),
        ];
    }

    public function onUpdate(array $arrayPatient, int $id): array
    {
        return Validator::make(

            $this->inicialiciteAtributes($arrayPatient),
            [
                'num_document' => [
                    'bail',
                    Rule::prohibitedIf(function () use ($arrayPatient) {
                        return empty($arrayPatient['document_id']) && ! empty($arrayPatient['num_document']);
                    }),
                    AttributeDocumentValidator::documentTypeUnique((int) $arrayPatient['document_id'], $arrayPatient['num_document'], $id),
                    AttributeValidator::stringValid(true, 5),
                ],
                'person_name' => AttributeValidator::stringValid(true, 3),
                'person_lastname' => AttributeValidator::stringValid(true, 3),
                'degree_id' => AttributeValidator::requireAndExists('degrees', 'id', 'degree_id'),
                'document_id' => AttributeValidator::requireAndExists('documents', 'id', 'document_id'),
                'state_id' => AttributeValidator::requireAndExists(true, 'states', 'id'),
                'person_address' => AttributeValidator::stringValid(false, 4),
                'person_phone' => AttributeValidator::stringValid(false, 5),
                'person_datebirth' => AttributeValidator::dateValid(true),
                'person_email' => AttributeValidator::emailValidById($id, 'people', 'person_email'),
                'province_id' => AttributeValidator::requireAndExists('provinces', 'id', 'province_id'),
                'gender_id' => AttributeValidator::requireAndExists('genders', 'id', 'gender_id'),
                'marital_status_id' => AttributeValidator::requireAndExists('marital_statuses', 'id', 'marital_status_id'),
                'occupation_id' => AttributeValidator::requireAndExists('occupations', 'id', 'occupation_id'),
                'nationality_id' => AttributeValidator::requireAndExists('nationalities', 'id', 'nationality_id'),
                'person_cpcode' => AttributeValidator::stringValid(false, 3),
            ],
            [
                'num_document.prohibited' => 'se requiere tipo de documento.',
            ],
            $this->niceNames()

        )->validate();
    }
}
