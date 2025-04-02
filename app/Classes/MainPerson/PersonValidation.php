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
                'document_id' => 'required',
                'num_document' => AttributeValidator::uniqueIdNameLength(5, 'people', 'num_document', null),
                'person_name' => AttributeValidator::stringValid(true, 4),
                'person_lastname' => AttributeValidator::stringValid(true, 4),
            ],
            [

            ],
            $this->niceNames()

        )->validate();
    }

    public function inicialiciteAtributes($person)
    {

        return [
            'document_id' => trim($person['document_id']),
            'num_document' => trim($person['num_document']),
            'person_name' => ucwords(mb_strtolower(trim($person['person_name']))),
            'person_lastname' => ucwords(mb_strtolower(trim($person['person_lastname']))),
        ];

    }

    public function niceNames(): array
    {
        return [
            'document_id' => config('nicename.status'),
            'person_name' => config('nicename.name'),
            'num_document' => config('nicename.documtnume'),
            'person_lastname' => config('nicename.apellido'),
        ];
    }
}
