<?php

declare(strict_types=1);

namespace App\Classes\Services;

use App\Interfaces\ModelEmail;

final class EmailsModel
{
    public function sendEmailCreate(ModelEmail $modelEmail, $model)
    {
        $modelEmail->sendEmailCreate($model);
    }

    public function sendEmailUpdate(ModelEmail $modelEmail, $model)
    {
        $modelEmail->sendEmailUpdate($model);
    }
}
