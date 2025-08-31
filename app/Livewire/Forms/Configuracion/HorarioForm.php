<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Configuracion;

use App\Classes\Configuracion\ScheduleValidation;
use Livewire\Form;

final class HorarioForm extends Form
{
    public $datahorario = [
        'day_of_week' => [
            0 => '',
            1 => '',
            2 => '',
            3 => '',
            4 => '',
            5 => '',
            6 => '',
        ],
        'morning_start' => [
            0 => '',
            1 => '',
            2 => '',
            3 => '',
            4 => '',
            5 => '',
            6 => ''],
        'morning_end' => [
            0 => '',
            1 => '',
            2 => '',
            3 => '',
            4 => '',
            5 => '',
            6 => '',
        ],
        'afternoon_start' => [
            0 => '',
            1 => '',
            2 => '',
            3 => '',
            4 => '',
            5 => '',
            6 => '',
        ],
        'afternoon_end' => [
            0 => '',
            1 => '',
            2 => '',
            3 => '',
            4 => '',
            5 => '',
            6 => '',
        ],
    ];

    public function scheduleStoreUpdate(ScheduleValidation $scheduleValidation)
    {

        $scheduleValidation->onScheduleCreate($this->datahorario);
        dd('lui');
    }
}
