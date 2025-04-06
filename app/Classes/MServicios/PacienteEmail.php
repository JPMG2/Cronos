<?php

declare(strict_types=1);

namespace App\Classes\MServicios;

use App\Interfaces\ModelEmail;
use App\Mail\Mservicios\PacientNewEmail;
use App\Mail\Mservicios\PacientUpdateEmail;
use Illuminate\Support\Facades\Mail;

final class PacienteEmail implements ModelEmail
{
    public function sendEmailCreate($model)
    {
        Mail::to($model->person->person_email)->send(new PacientNewEmail($model));
    }

    public function sendEmailUpdate($model)
    {
        Mail::to($model->person->person_email)->send(new PacientUpdateEmail($model));
    }
}
