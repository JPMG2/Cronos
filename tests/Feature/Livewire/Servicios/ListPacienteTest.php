<?php

declare(strict_types=1);

use App\Livewire\Servicios\ListPaciente;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ListPaciente::class)
        ->assertStatus(200);
});
