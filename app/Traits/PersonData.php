<?php

declare(strict_types=1);

namespace App\Traits;

trait PersonData
{
    public ?int $person_id = null;

    public string $name_person = '';

    public string $lastname_person = '';

    public string $documentType_person = '';

    public ?int $documentTypeId_person = null;

    public string $document_person = '';

    public string $email_person = '';

    public string $phone_person = '';

    public string $person_address = '';

    public ?string $person_cpcode = null;

    public ?int $gender_id;

    public function setPersonInfo($data): void
    {

        $this->person_id = $data->id;
        $this->gender_id = $data->gender_id ?? 0;
        $this->name_person = $data->person_name;
        $this->lastname_person = $data->person_lastname;
        $this->documentType_person = $data->document->document_name;
        $this->document_person = $data->num_document;
        $this->email_person = $data->person_email;
        $this->phone_person = $data->person_phone;
        $this->documentTypeId_person = $data->document_id;
        $this->person_address = $data->person_address;
        $this->person_cpcode = $data->person_cpcode;
    }

    public function getPersonInfo(): array
    {
        return [
            'person_id' => $this->person_id,
            'gender_id' => $this->gender_id,
            'person_name' => $this->name_person,
            'person_lastname' => $this->lastname_person,
            'document_id' => $this->documentTypeId_person,
            'num_document' => $this->document_person,
            'person_email' => $this->email_person,
            'person_phone' => $this->phone_person,
            'person_address' => $this->person_address,
            'person_cpcode' => $this->person_cpcode,
        ];
    }

    private function categorizePersonData(array $searchResult): void
    {

        [$role, $data] = $searchResult;

        match ($role) {
            'M' => $this->medicalPerson($data),
            'T' => $this->patientPerson($data),
            'P' => $this->regularPerson($data),
        };
    }

    private function regularPerson($data): void
    {
        $this->setPersonInfo($data);
        $this->js("window.dispatchEvent(new CustomEvent('open-modal-data'))");
    }

    private function infoPersonArray(array $data): array
    {
        return array_replace($data, copyKeysArray($this->getPersonInfo(), $data));
    }
}
