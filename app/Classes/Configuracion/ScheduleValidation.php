<?php

declare(strict_types=1);

namespace App\Classes\Configuracion;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

final class ScheduleValidation
{
    public function onScheduleCreate(array $schedule): void
    {
        $data = $this->inicialiciteAtributes($schedule);

        Validator::make(
            $data,
            [
                'day_of_week' => AttributeValidator::hasTobeArray(1),
                'morning_start' => AttributeValidator::scheduleArray($schedule),
            ],
            [],
            $this->niceNames(),
        )->validate();

    }

    public function inicialiciteAtributes(array $schedule): array
    {

        return [
            'day_of_week' => $schedule['day_of_week'],
            'morning_start' => $schedule['morning_start'],
        ];

    }

    public function niceNames(): array
    {
        return [
            'day_of_week' => config('nicename.day_of_week'),

        ];
    }
}
