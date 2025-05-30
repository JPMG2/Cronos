<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ModelEmail
{
    public function sendEmailCreate($model);

    public function sendEmailUpdate($model);
}
