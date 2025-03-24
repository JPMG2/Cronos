<?php

declare(strict_types=1);

use App\Livewire\Servicios\RePaciente;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(RePaciente::class)
        ->assertStatus(200);
});
