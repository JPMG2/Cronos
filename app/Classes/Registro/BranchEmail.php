<?php

namespace App\Classes\Registro;

use App\Interfaces\ModelEmail;
use App\Mail\Registro\BranchCreateMail;
use App\Mail\Registro\BranchUpdateMail;
use Illuminate\Support\Facades\Mail;

class BranchEmail implements ModelEmail
{
    public function sendEmailCreate($model)
    {
        Mail::to($model->branch_email)->send(new BranchCreateMail($model));
    }

    public function sendEmailUpdate($model)
    {
        Mail::to($model->branch_email)->send(new BranchUpdateMail($model));
    }
}
