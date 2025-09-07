<?php

declare(strict_types=1);

use App\Livewire\Convenio\ListObraSocial;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ListObraSocial::class)
        ->assertStatus(200);
});
