<?php

declare(strict_types=1);

namespace App\Classes\MServicios;

use App\Interfaces\ModelEmail;
use Illuminate\Support\Facades\Mail;

final class PersonEmail implements ModelEmail
{
    private $emailClass;

    public function __construct($emailClass)
    {
        $this->emailClass = $emailClass;
    }

    public function sendEmailCreate($model)
    {
        Mail::to($model->person_email)->send(new $this->emailClass($model));
    }

    public function sendEmailUpdate($model)
    {

        Mail::to($model->person_email)->send(new $this->emailClass($model));
    }
}
