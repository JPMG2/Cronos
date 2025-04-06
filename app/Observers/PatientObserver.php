<?php

declare(strict_types=1);

namespace App\Observers;

use App\Classes\MServicios\PacienteEmail;
use App\Classes\Services\EmailsModel;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

final class PatientObserver
{
    /**
     * Handle the Patient "created" event.
     */
    public function created(Patient $patient): void
    {
        if (! empty($patient->person->person_email)) {

            $this->sendEmail($patient, 'created');
        }
    }

    /**
     * Handle the Patient "updated" event.
     */
    public function updated(Patient $patient): void
    {
        //
    }

    /**
     * Handle the Patient "deleted" event.
     */
    public function deleted(Patient $patient): void
    {
        //
    }

    public function sendEmail(Model $model, $action)
    {

        $classemail = new EmailsModel;

        if ($action === 'update') {
            $classemail->sendEmailUpdate(new PacienteEmail(), $model);
        } else {
            $classemail->sendEmailCreate(new PacienteEmail(), $model);
        }
    }
}
