<?php

namespace App\Observers;

use App\Classes\Services\EmailsModel;
use Illuminate\Database\Eloquent\Model;

class EmailModelObserver
{
    public function created(Model $model)
    {
        $baseclass = trim('App\Classes\Registro\ ').class_basename($model).'Email';

        $this->sendEmail($model, 'created', $baseclass);
    }

    public function sendEmail(Model $model, $action, $class)
    {

        $classemail = new EmailsModel();

        if ($action == 'update') {
            $classemail->sendEmailUpdate(new $class(), $model);
        } else {
            $classemail->sendEmailCreate(new $class(), $model);
        }
    }

    public function updated(Model $model)
    {

        $baseclass = trim('App\Classes\Registro\ ').class_basename($model).'Email';

        $model->isDirty($model->checkchange) && $this->sendEmail($model, 'update', $baseclass);
    }
}
