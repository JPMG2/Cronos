<?php

declare(strict_types=1);

namespace App\Action\PersonAct;

use App\Classes\Services\ModelService;
use App\Models\Person;

final class UpdatePerson
{
    public function handle(array $personData, int $id): Person
    {
        return app()->make(ModelService::class, ['model' => new Person()])
            ->update($personData, $id);

    }
}
