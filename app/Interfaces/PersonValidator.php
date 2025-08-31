<?php

declare(strict_types=1);

namespace App\Interfaces;

interface PersonValidator
{
    public function validateForCreate(array $data): array;

    public function validateForUpdate(array $data, int $id): array;
}
