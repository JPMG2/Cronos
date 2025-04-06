<?php

declare(strict_types=1);

namespace App\Classes\MainPerson;

use App\Classes\Utilities\AttributeDocumentValidator;
use Illuminate\Support\Facades\Validator;

final class PatientPersonValidation
{
    public function onPatientPersonCreate(array $person)
    {

        return Validator::make(

            $this->inicialiciteAtributes($person),
            [
                'document_id' => 'required',
                'num_document' => [
                    'required',
                    'min:5',
                    'unique' => AttributeDocumentValidator::documentTypeUnique((int) $person['document_id'], $person['num_document'], null),
                ],

            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }

    public function inicialiciteAtributes($person)
    {

        return [
            'document_id' => trim((string) $person['document_id']),
            'num_document' => trim($person['num_document']),

        ];

    }

    public function niceNames(): array
    {
        return [
            'document_id' => config('nicename.status'),
            'num_document' => config('nicename.documtnume'),
        ];
    }
}
