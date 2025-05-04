<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Configuracion;

use Livewire\Form;

final class HorarioForm extends Form
{
    public $datahorario = [
        'day_of_week' => [],
        'morning_start' => [],
        'morning_end' => [],
        'afternoon_start' => [],
        'afternoon_end' => [],
    ];

    public function scheduleStoreUpdate() {}
}
