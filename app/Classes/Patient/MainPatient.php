<?php

declare(strict_types=1);

namespace App\Classes\Patient;

use App\Events\PersonType;
use App\Mail\Clinico\PacientCreate;
use App\Mail\Clinico\PacientUpdate;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

final class MainPatient
{
    public function show(int $id): Patient
    {
        return Patient::with(Patient::getRelationModel())->findorFail($id);
    }

    /**
     * @param  Patient  $model
     */
    public function handleNotification(Model $model, $emailChange = null): void
    {
        $action = '';
        $mainClass = '';
        if ($model->wasRecentlyCreated && $model->person->hasEmail()) {
            $action = 'create';
            $mainClass = PacientCreate::class;
        } elseif ($emailChange) {
            $action = 'update';
            $mainClass = PacientUpdate::class;
        }
        if ($mainClass !== '') {
            event(new PersonType('patient', $model, $action, $model->person->person_email, $mainClass));
        }
    }
}
