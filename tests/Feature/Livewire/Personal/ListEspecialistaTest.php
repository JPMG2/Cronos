<?php

declare(strict_types=1);

use App\Livewire\Maestro\ListEspecialista;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ListEspecialista::class)
        ->assertStatus(200);
});
