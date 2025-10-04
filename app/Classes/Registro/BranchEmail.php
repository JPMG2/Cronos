<?php

declare(strict_types=1);

namespace App\Classes\Registro;

use App\Interfaces\ModelEmail;
use Illuminate\Support\Facades\Mail;

final class BranchEmail implements ModelEmail
{
    public function __construct(private $emailClass)
    {
    }

    public function sendEmailCreate($model, $receptor)
    {
        Mail::to($model->branch_email)->queue(new $this->emailClass($model));
    }

    public function sendEmailUpdate($model, $receptor)
    {
        Mail::to($model->branch_email)->queue(new $this->emailClass($model));
    }
}
