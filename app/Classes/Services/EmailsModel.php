<?php

declare(strict_types=1);

namespace App\Classes\Services;

use App\Interfaces\ModelEmail;

final class EmailsModel
{
    public function sendEmailCreate(ModelEmail $modelEmail, $model, $receptor): void
    {
        $modelEmail->sendEmailCreate($model, $receptor);
    }

    public function sendEmailUpdate(ModelEmail $modelEmail, $model, $receptor): void
    {
        $modelEmail->sendEmailUpdate($model, $receptor);
    }
}
