<?php

declare(strict_types=1);

namespace App\Classes\Personal;

use App\Action\PersonalAct\SendPersonEmail;
use App\Classes\Person\PersonEmail;
use App\Events\PersonType;
use Closure;

final class MedicHandler
{
    public function handle(PersonType $event, Closure $next)
    {

        if ($event->personType === 'medic') {
            $sendEmail = app(SendPersonEmail::class);
            $sendEmail->handle(
                $event,
                $event->action === 'create' ? $sendEmail::ACTION_CREATE : $sendEmail::ACTION_UPDATE,
                PersonEmail::class,
            );
        }

        return $next($event);
    }
}
