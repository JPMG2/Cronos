<?php

use App\Livewire\Gestion\ListObraSocial;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ListObraSocial::class)
        ->assertStatus(200);
});
