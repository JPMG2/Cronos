<?php

declare(strict_types=1);

namespace App\Classes\Services;

use App\Interfaces\PersonValidator;

final class PersonTypeValidator implements PersonValidator
{
    public function __construct(private $personType) {}

    public function validateForCreate(array $data): array
    {
        return $this->personType->onCreate($data);
    }

    public function validateForUpdate(array $data, int $id): array
    {
        return $this->personType->onUpdate($data, $id);
    }
}
