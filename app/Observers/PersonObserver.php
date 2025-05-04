<?php

declare(strict_types=1);

namespace App\Observers;

use App\Action\SendEmail;
use App\Classes\MServicios\PersonEmail;
use App\Mail\Mservicios\PacientUpdateEmail;
use App\Models\Person;

final class PersonObserver
{
    public function __construct(
        private readonly SendEmail $sendEmail
    ) {}

    public function created(Person $person): void {}

    public function updated(Person $person): void
    {
        if ($person->patiente()->exists() && ! empty($person->person_email) && $person->isDirty('person_email')) {
            $this->sendEmail->handle(
                $person,
                SendEmail::ACTION_UPDATE,
                PersonEmail::class,
                PacientUpdateEmail::class
            );
        }
    }
}
