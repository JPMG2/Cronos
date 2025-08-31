<?php

declare(strict_types=1);

namespace App\Classes\Patient;

use App\Action\PersonalAct\SendPersonEmail;
use App\Classes\Person\PersonEmail;
use App\Events\PersonType;
use Closure;

final class PacienteHandler
{
    public function handle(PersonType $event, Closure $next)
    {

        if ($event->personType === 'patient') {
            $sendEmail = app(SendPersonEmail::class);
            $sendEmail->handle(
                $event,
                $event->action === 'create' ? $sendEmail::ACTION_CREATE : $sendEmail::ACTION_UPDATE,
                PersonEmail::class
            );
        }

        return $next($event);
    }
}
