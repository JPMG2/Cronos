<?php

declare(strict_types=1);

namespace App\Action\PersonalAct;

use App\Action\PersonAct\CreatePerson;
use App\Models\Medical;
use App\Traits\UtilityForm;

final class CreateMedic
{
    use UtilityForm;

    public function __construct(private readonly CreatePerson $createPerson)
    {
    }

    public function handle(array $dataMedic): Medical
    {

        $person = $this->createPerson->handle($dataMedic);

        return $person->medical()->create($this->getValuesModel($dataMedic, new Medical()));
    }
}
