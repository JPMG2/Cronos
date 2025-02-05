<?php

use App\Livewire\Personal\ReEspecialista;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReEspecialista::class)
        ->assertStatus(200);
});
