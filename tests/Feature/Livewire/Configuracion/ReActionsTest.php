<?php

declare(strict_types=1);

use App\Livewire\Configuracion\ReActions;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReActions::class)
        ->assertStatus(200);
});
