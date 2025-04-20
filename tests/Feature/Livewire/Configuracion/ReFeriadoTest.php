<?php

declare(strict_types=1);

use App\Livewire\Configuracion\ReFeriado;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReFeriado::class)
        ->assertStatus(200);
});
