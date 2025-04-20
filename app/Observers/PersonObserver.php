<?php

declare(strict_types=1);

namespace App\Observers;

use App\Classes\MServicios\PersonEmail;
use App\Classes\Services\EmailsModel;
use App\Mail\Mservicios\PacientNewEmail;
use App\Mail\Mservicios\PacientUpdateEmail;
use App\Models\Person;
use Illuminate\Database\Eloquent\Model;

final class PersonObserver
{
    public function created(Person $person): void
    {
        if ($person->patiente()->exists() && ! is_null($person->person_email)) {
            $this->sendEmail($person, 'created', PersonEmail::class, PacientNewEmail::class);
        }
    }

    public function sendEmail(Model $model, $action, string $emailClass, string $mailableClass)
    {

        $classemail = new EmailsModel;

        if ($action === 'update') {
            $classemail->sendEmailUpdate(new $emailClass($mailableClass), $model);
        } else {
            $classemail->sendEmailCreate(new $emailClass($mailableClass), $model);
        }
    }

    public function updated(Person $person): void
    {

        if ($person->patiente()->exists() && ! is_null($person->person_email) && $person->isDirty('person_email')) {
            $this->sendEmail($person, 'update', PersonEmail::class, PacientUpdateEmail::class);
        }
    }
}
