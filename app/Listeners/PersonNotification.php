<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Classes\Patient\PacienteHandler;
use App\Classes\Personal\MedicHandler;
use App\Events\PersonType;
use Illuminate\Pipeline\Pipeline;

final class PersonNotification
{
    /**
     * Handle the event.
     */
    public function handle(PersonType $event): void
    {

        $pipeline = app(Pipeline::class);
        $pipeline
            ->send($event)
            ->through(
                [
                    MedicHandler::class,
                    PacienteHandler::class,
                ],
            )->then(fn ($result) => $result);

    }
}
