<?php

declare(strict_types=1);

namespace App\Classes\Personal;

use App\Classes\Utilities\AttributeDocumentValidator;
use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

final class EspecialistValidation
{
    public function onCreate(array $especialsit): array
    {
        return Validator::make(

            $this->inicialiciteAtributes($especialsit),
            [
                'person_name' => AttributeValidator::stringValid(true, 3),
                'person_lastname' => AttributeValidator::stringValid(true, 3),
                'degree_id' => AttributeValidator::requireAndExists('degrees', 'id', 'degree_id', 'require'),
                'credential_id' => AttributeValidator::requireAndExists('credentials', 'id', 'credential_id', 'require'),
                'specialty_id' => AttributeValidator::requireAndExists('specialties', 'id', 'specialty_id'),
                'document_id' => AttributeValidator::requireAndExists('documents', 'id', 'document_id'),
                'num_document' => [
                    'bail',
                    Rule::prohibitedIf(function () use ($especialsit) {
                        return empty($especialsit['document_id']) && ! empty($especialsit['num_document']);
                    }),
                    AttributeDocumentValidator::documentTypeUnique((int) $especialsit['document_id'], $especialsit['num_document'], null),
                    AttributeValidator::stringValid(true, 5),
                ],
                'medical_codenumber' => [
                    'bail',
                    'required',
                    AttributeValidator::medicalCredential((int) $especialsit['credential_id'], $especialsit['medical_codenumber'], null),
                ],
                'state_id' => AttributeValidator::requireAndExists('states', 'id', 'state_id'),
                'person_address' => AttributeValidator::stringValid(false, 4),
                'person_phone' => AttributeValidator::stringValid(false, 5),
                'person_email' => AttributeValidator::emailValid('people', 'person_email'),
            ],
            [
                'num_document.prohibited' => 'se requiere tipo de documento.',
            ],
            $this->niceNames()

        )->validate();

    }

    public function inicialiciteAtributes($especialsit): array
    {
        return [
            'document_id' => mb_trim((string) $especialsit['document_id']),
            'num_document' => mb_trim((string) $especialsit['num_document']),
            'person_name' => mb_trim((string) $especialsit['person_name']),
            'person_lastname' => mb_trim((string) $especialsit['person_lastname']),
            'state_id' => mb_trim((string) $especialsit['state_id']),
            'credential_id' => mb_trim((string) $especialsit['credential_id']),
            'specialty_id' => mb_trim((string) $especialsit['specialty_id']),
            'degree_id' => mb_trim((string) $especialsit['degree_id']),
            'medical_codenumber' => mb_trim($especialsit['medical_codenumber']),
            'person_address' => mb_trim((string) $especialsit['person_address']),
            'person_phone' => mb_trim((string) $especialsit['person_phone']),
            'person_email' => mb_strtolower(mb_trim((string) $especialsit['person_email'])),
        ];

    }

    public function niceNames(): array
    {
        return [
            'document_id' => config('nicename.documtype'),
            'person_name' => config('nicename.name'),
            'person_lastname' => config('nicename.apellido'),
            'state_id' => config('nicename.status'),
            'credential_id' => config('nicename.matricula'),
            'specialty_id' => config('nicename.especialist'),
            'degree_id' => config('nicename.titulo'),
            'medical_codenumber' => config('nicename.codigomedico'),
            'person_address' => config('nicename.direccion'),
            'person_phone' => config('nicename.telefono'),
            'person_email' => config('nicename.correo'),
            'num_document' => config('nicename.documtnume'),
        ];
    }

    public function onUpdate(array $especialsit, int $id): array
    {

        return Validator::make(

            $this->inicialiciteAtributes($especialsit),
            [
                'person_name' => AttributeValidator::stringValid(true, 3),
                'person_lastname' => AttributeValidator::stringValid(true, 3),
                'degree_id' => AttributeValidator::requireAndExists('degrees', 'id', 'degree_id', 'require'),
                'credential_id' => AttributeValidator::requireAndExists('credentials', 'id', 'credential_id', 'require'),
                'specialty_id' => AttributeValidator::requireAndExists('specialties', 'id', 'specialty_id'),
                'document_id' => AttributeValidator::requireAndExists('documents', 'id', 'document_id'),
                'num_document' => [
                    'bail',
                    Rule::prohibitedIf(function () use ($especialsit) {
                        return empty($especialsit['document_id']) && ! empty($especialsit['num_document']);
                    }),
                    AttributeDocumentValidator::documentTypeUnique((int) $especialsit['document_id'], $especialsit['num_document'], $id),
                    AttributeValidator::stringValid(true, 5),
                ],
                'medical_codenumber' => [
                    'bail',
                    'required',
                    AttributeValidator::medicalCredential((int) $especialsit['credential_id'], $especialsit['medical_codenumber'], (int) $id),
                ],
                'state_id' => AttributeValidator::requireAndExists('states', 'id', 'state_id'),
                'person_address' => AttributeValidator::stringValid(false, 4),
                'person_phone' => AttributeValidator::stringValid(false, 5),
                'person_email' => AttributeValidator::emailValidById($id, 'people', 'person_email'),
            ],
            [
                'num_document.prohibited' => 'se requiere tipo de documento.',
            ],
            $this->niceNames()

        )->validate();
    }
}
