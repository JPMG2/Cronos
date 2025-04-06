<?php

declare(strict_types=1);

use App\Livewire\Configuracion\ReRoles;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReRoles::class)
        ->assertStatus(200);
});
