<?php

declare(strict_types=1);

namespace App\Observers;

use App\Action\SendEmail;
use App\Classes\MServicios\PersonEmail;
use App\Mail\Mservicios\PacientNewEmail;
use App\Models\Patient;

final class PatientObserver
{
    public function __construct(
        private readonly SendEmail $sendEmail
    ) {}

    public function created(Patient $patient): void
    {
        if (! empty($patient->person->person_email)) {
            $this->sendEmail->handle(
                $patient->person,
                SendEmail::ACTION_CREATE,
                PersonEmail::class,
                PacientNewEmail::class
            );
        }
    }
}
