<?php

declare(strict_types=1);

namespace App\Action\Patient;

use App\Action\PersonAct\CreatePerson;
use App\Models\Patient;
use App\Traits\UtilityForm;

final class CreatePatiente
{
    use UtilityForm;

    protected string $modelName;

    public function __construct(private readonly CreatePerson $createPerson) {}

    public function handle(array $dataPatient): Patient
    {
        $person = $this->createPerson->handle($dataPatient);

        return $person->patiente()->create($this->getValuesModel($dataPatient, new Patient()));
    }
}
