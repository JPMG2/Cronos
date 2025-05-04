<?php

declare(strict_types=1);

namespace App\Classes\MServicios;

use App\Interfaces\ModelEmail;
use Illuminate\Support\Facades\Mail;

final class PersonEmail implements ModelEmail
{
    public function __construct(private $emailClass) {}

    public function sendEmailCreate($model): void
    {
        Mail::to($model->person_email)->send(new $this->emailClass($model));
    }

    public function sendEmailUpdate($model): void
    {

        Mail::to($model->person_email)->send(new $this->emailClass($model));
    }
}
