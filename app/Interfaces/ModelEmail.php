<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ModelEmail
{
    public function sendEmailCreate($model, $receptor);

    public function sendEmailUpdate($model, $receptor);
}
