<?php

declare(strict_types=1);

namespace App\Dto;

use Livewire\Wireable;

final class PatientDto implements Wireable
{
    /**
     * Person-related form state.
     */
    public function __construct(
        public ?int $person_id = null,
        public string $person_name = '',
        public string $person_lastname = '',
        public string $person_address = '',
        public string $person_phone = '',
        public string $person_email = '',
        public int $document_id = 1,
        public string $num_document = '',
        public ?int $province_id = null,
        public ?int $gender_id = null,
        public ?int $marital_status_id = null,
        public ?int $occupation_id = null,
        public ?int $nationality_id = null,
        public ?string $person_datebirth = null,
        public string $person_cpcode = '',
    ) {}

    public static function fromLivewire($value): self
    {
        return self::fromArray(is_array($value) ? $value : []);

    }

    public static function fromArray(array $data): self
    {

        return new self(
            person_id: $data['person_id'] ?? null,
            person_name: (string) ($data['person_name'] ?? ''),
            person_lastname: (string) ($data['person_lastname'] ?? ''),
            person_address: (string) ($data['person_address'] ?? ''),
            person_phone: (string) ($data['person_phone'] ?? ''),
            person_email: (string) ($data['person_email'] ?? ''),
            document_id: (int) ($data['document_id'] ?? 1),
            num_document: (string) ($data['num_document'] ?? ''),
            province_id: (int) ($data['province_id'] ?? null),
            gender_id: (int) ($data['gender_id'] ?? null),
            marital_status_id: (int) ($data['marital_status_id'] ?? null),
            occupation_id: (int) ($data['occupation_id'] ?? null),
            nationality_id: (int) ($data['nationality_id'] ?? null),
            person_datebirth: (string) ($data['person_datebirth'] ?? null),
            person_cpcode: (string) ($data['person_cpcode'] ?? ''),
        );
    }

    public function toLivewire(): array
    {
        return $this->toArray();

    }

    public function toArray(): array
    {
        return [
            'person_id' => $this->person_id,
            'person_name' => $this->person_name,
            'person_lastname' => $this->person_lastname,
            'person_address' => $this->person_address,
            'person_phone' => $this->person_phone,
            'person_email' => $this->person_email,
            'document_id' => $this->document_id,
            'num_document' => $this->num_document,
            'province_id' => $this->province_id,
            'gender_id' => $this->gender_id,
            'marital_status_id' => $this->marital_status_id,
            'occupation_id' => $this->occupation_id,
            'nationality_id' => $this->nationality_id,
            'person_datebirth' => $this->person_datebirth,
            'person_cpcode' => $this->person_cpcode,
        ];
    }
}
