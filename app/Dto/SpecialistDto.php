<?php

declare(strict_types=1);

namespace App\Dto;

use Livewire\Wireable;

final class SpecialistDto implements Wireable
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
        public ?int $city_id = null,
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
            city_id: (int) ($data['city_id'] ?? null),
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
        ];
    }
}
