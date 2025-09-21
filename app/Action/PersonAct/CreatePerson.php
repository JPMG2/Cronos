<?php

declare(strict_types=1);

namespace App\Action\PersonAct;

use App\Classes\Utilities\QueryRepository;
use App\Models\Person;

final class CreatePerson
{
    public function handle(array $personData): Person
    {

        return new QueryRepository(new Person())->create($personData);

    }
}
