<?php

use App\Livewire\Configuracion\ReRoles;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReRoles::class)
        ->assertStatus(200);
});
