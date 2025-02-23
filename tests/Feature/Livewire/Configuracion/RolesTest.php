<?php

use App\Livewire\Configuracion\Roles;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Roles::class)
        ->assertStatus(200);
});
