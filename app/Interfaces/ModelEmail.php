<?php

namespace App\Interfaces;

interface ModelEmail
{
    public function sendEmailCreate($model);

    public function sendEmailUpdate($model);
}
