<?php

declare(strict_types=1);

namespace App\Classes\Person;

use App\Models\Person;

final class MainPerson
{
    public ?Person $person {
        get {
            return $this->findPerson($this->documentNum);
        }
    }

    private ?string $documentNum = null;

    public function findAsMedic(?string $documentNum): ?array
    {
        $this->documentNum = $documentNum;
        $person = $this->person;

        if (! $person) {
            return null;
        }

        return ($person->medical) ? ['M', $person->medical->id] : ['P', $person];
    }

    public function findAsPatient(?string $documentNum): ?array
    {
        $this->documentNum = $documentNum;
        $person = $this->person;
        if (! $person) {
            return null;
        }

        return ($person->patiente) ? ['T', $person->patiente->id] : ['P', $person];
    }

    private function findPerson(string $documentNum): ?Person
    {
        return Person::query()->with('medical:id,person_id')
            ->where('num_document', $documentNum)->first();
    }
}
