<?php

declare(strict_types=1);

namespace App\Classes\Person;

use App\Interfaces\ModelEmail;
use Illuminate\Support\Facades\Mail;

final class PersonEmail implements ModelEmail
{
    public function __construct(private $emailClass) {}

    public function sendEmailCreate($model, $receptor): void
    {
        Mail::to($receptor)->queue(new $this->emailClass($model));
    }

    public function sendEmailUpdate($model, $receptor): void
    {
        Mail::to($receptor)->queue(new $this->emailClass($model));
    }
}
