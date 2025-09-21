<?php

declare(strict_types=1);

namespace App\Action\PersonAct;

use App\Classes\Utilities\QueryRepository;
use App\Models\Person;
use Illuminate\Database\Eloquent\Model;

final class UpdatePerson
{
    public function handle(array $personData, int $id): Model
    {
        return new QueryRepository(new Person())->update($id, $personData);

    }
}
