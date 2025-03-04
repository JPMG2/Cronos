<?php

use App\Livewire\Configuracion\ReAcceso;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReAcceso::class)
        ->assertStatus(200);
});
