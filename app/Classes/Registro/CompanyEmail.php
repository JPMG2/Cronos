<?php

declare(strict_types=1);

namespace App\Classes\Registro;

use App\Interfaces\ModelEmail;
use App\Mail\Registro\CompanyCreateMail;
use App\Mail\Registro\CompanyUpdateMail;
use Illuminate\Support\Facades\Mail;

final class CompanyEmail implements ModelEmail
{
    public function sendEmailCreate($model)
    {
        Mail::to($model->company_email)->send(new CompanyCreateMail($model));
    }

    public function sendEmailUpdate($model)
    {
        Mail::to($model->company_email)->send(new CompanyUpdateMail($model));
    }
}
