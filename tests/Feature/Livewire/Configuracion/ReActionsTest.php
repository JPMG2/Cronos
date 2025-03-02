<?php

use App\Livewire\Configuracion\ReActions;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReActions::class)
        ->assertStatus(200);
});
