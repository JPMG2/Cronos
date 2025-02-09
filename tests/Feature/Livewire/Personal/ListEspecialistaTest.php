<?php

use App\Livewire\Personal\ListEspecialista;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ListEspecialista::class)
        ->assertStatus(200);
});
