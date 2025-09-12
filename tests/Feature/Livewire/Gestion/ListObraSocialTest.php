<?php

declare(strict_types=1);

use App\Livewire\Convenio\ListPrestador;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ListPrestador::class)
        ->assertStatus(200);
});
