<?php

declare(strict_types=1);

use App\Livewire\Configuracion\ReHorario;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReHorario::class)
        ->assertStatus(200);
});
