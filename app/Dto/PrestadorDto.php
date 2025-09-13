<?php

declare(strict_types=1);

namespace App\Dto;

use Livewire\Wireable;

final class PrestadorDto implements Wireable
{
    public function __construct(
        public ?int $insurance_type_id = null,
        public int $state_id = 1,
        public ?int $province_id = null,
        public ?int $city_id = null,
        public string $insurance_name = '',
        public string $insurance_acronym = '',
        public string $insurance_code = '',
        public string $insurance_cuit = '',
        public string $insurance_address = '',
        public string $insurance_phone = '',
        public string $insurance_zipcode = '',
        public string $insurance_email = '',
        public string $insurance_web = '',
        public string $insurance_type_name = '',
    ) {}

    public static function fromLivewire($value)
    {
        return self::fromArray(is_array($value) ? $value : []);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            insurance_type_id: ! empty($data['insurance_type_id']) ? (int) $data['insurance_type_id'] : null,
            state_id: (int) ($data['state_id'] ?? ''),
            province_id: ! empty($data['province_id']) ? (int) $data['province_id'] : null,
            city_id: ! empty($data['city_id']) ? (int) $data['city_id'] : null,
            insurance_name: (string) ($data['insurance_name'] ?? ''),
            insurance_acronym: (string) ($data['insurance_acronym'] ?? ''),
            insurance_code: (string) ($data['insurance_code'] ?? ''),
            insurance_cuit: (string) ($data['insurance_cuit'] ?? ''),
            insurance_address: (string) ($data['insurance_address'] ?? ''),
            insurance_phone: (string) ($data['insurance_phone'] ?? ''),
            insurance_zipcode: (string) ($data['insurance_zipcode'] ?? ''),
            insurance_email: (string) ($data['insurance_email'] ?? ''),
            insurance_web: (string) ($data['insurance_web'] ?? ''),
            insurance_type_name: (string) ($data['insurance_type_name'] ?? ''),
        );
    }

    public function toLivewire()
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'insurance_type_id' => $this->insurance_type_id,
            'state_id' => $this->state_id,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'insurance_name' => $this->insurance_name,
            'insurance_acronym' => $this->insurance_acronym,
            'insurance_code' => $this->insurance_code,
            'insurance_cuit' => $this->insurance_cuit,
            'insurance_address' => $this->insurance_address,
            'insurance_phone' => $this->insurance_phone,
            'insurance_zipcode' => $this->insurance_zipcode,
            'insurance_email' => $this->insurance_email,
            'insurance_web' => $this->insurance_web,
            'insurance_type_name' => $this->insurance_type_name,
        ];
    }
}
