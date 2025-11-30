<?php

declare(strict_types=1);

namespace App\Classes\Personal;

use App\Events\PersonType;
use App\Mail\Registro\MedicCreate;
use App\Mail\Registro\MedicUpadte;
use App\Models\Credential;
use App\Models\Medical;
use Illuminate\Database\Eloquent\Model;

final class MainMedic
{
    public function show(int $id): Medical
    {
        return Medical::with(Medical::getRelationModel())->findorFail($id);
    }

    public function attachCredential(int $credentialId, $medic, string $credentialNumber): void
    {
        Credential::query()->findOrFail($credentialId);

        $medic->credentials()->sync(
            [
                $credentialId => ['credential_number' => $credentialNumber],
            ],
        );

    }

    public function handleNotification(Model $model, $emailChange = null): void
    {
        $action = '';
        $mainClass = '';
        if ($model->wasRecentlyCreated && $model->person->hasEmail()) {
            $action = 'create';
            $mainClass = MedicCreate::class;
        } elseif ($emailChange) {
            $action = 'update';
            $mainClass = MedicUpadte::class;
        }
        if ($mainClass !== '') {
            PersonType::dispatch('medic', $model, $action, $model->person->person_email, $mainClass);
        }
    }
}
