<?php

declare(strict_types=1);

namespace App\Classes\Personal;

use App\Classes\Utilities\AttributeDocumentValidator;
use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

final class EspecialistValidation
{
    public function validateServiceData(?int $excludeId, array $data): array
    {
        return Validator::make(
            $this->transformServiceData($data),
            $this->getValidationRules($excludeId, $data),
            [
                'num_document.prohibited' => 'se requiere tipo de documento.',
            ],
            $this->getValidationAttributes()
        )->validate();
    }

    private function transformServiceData($data): array
    {
        return [
            'document_id' => mb_trim((string) $data['document_id']),
            'num_document' => mb_trim((string) $data['num_document']),
            'person_name' => mb_trim((string) $data['person_name']),
            'person_lastname' => mb_trim((string) $data['person_lastname']),
            'credential_id' => mb_trim((string) $data['credential_id']),
            'specialty_id' => mb_trim((string) $data['specialty_id']),
            'degree_id' => mb_trim((string) $data['degree_id']),
            'medical_codenumber' => mb_trim($data['medical_codenumber']),
            'person_address' => mb_trim((string) $data['person_address']),
            'person_phone' => mb_trim((string) $data['person_phone']),
            'person_email' => mb_strtolower(mb_trim((string) $data['person_email'])),
        ];
    }

    private function getValidationRules(?int $excludeId, array $especialsit): array
    {
        return [
            'person_name' => AttributeValidator::stringValid(true, 3),
            'person_lastname' => AttributeValidator::stringValid(true, 3),
            'degree_id' => AttributeValidator::requireAndExists('degrees', 'id', 'degree_id', 'require'),
            'credential_id' => AttributeValidator::requireAndExists('credentials', 'id', 'credential_id', 'require'),
            'specialty_id' => AttributeValidator::requireAndExists('specialties', 'id', 'specialty_id'),
            'document_id' => AttributeValidator::requireAndExists('documents', 'id', 'document_id'),
            'num_document' => [
                'bail',
                Rule::prohibitedIf(
                    function () use ($especialsit) {
                        return empty($especialsit['document_id']) && ! empty($especialsit['num_document']);
                    }
                ),
                function ($attribute, $value, $fail) use ($especialsit, $excludeId) {
                    if (! empty($especialsit['document_id']) && ! empty($value)) {
                        $validator = AttributeDocumentValidator::documentTypeUnique((int) $especialsit['document_id'], $value, $excludeId);
                        $validator->validate($attribute, $value, $fail);
                    }
                },
                AttributeValidator::stringValid(true, 5),
            ],
            'medical_codenumber' => [
                'bail',
                'required',
                function ($attribute, $value, $fail) use ($especialsit, $excludeId) {
                    if (! empty($especialsit['credential_id']) && ! empty($value)) {
                        $validator = AttributeValidator::medicalCredential((int) $especialsit['credential_id'], $value, $excludeId);
                        $validator->validate($attribute, $value, $fail);
                    }
                },
            ],
            'person_address' => AttributeValidator::stringValid(false, 4),
            'person_phone' => AttributeValidator::stringValid(false, 5),
            'person_email' => $excludeId
                ? AttributeValidator::emailValidById($excludeId, 'people', 'person_email')
                : ['sometimes', 'email:rfc,dns', 'unique:people,person_email', 'regex:/^([^<>]*)$/', 'max:255'],
        ];
    }

    private function getValidationAttributes(): array
    {
        return [
            'document_id' => config('nicename.documtype'),
            'person_name' => config('nicename.name'),
            'person_lastname' => config('nicename.apellido'),
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
}
