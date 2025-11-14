<?php

declare(strict_types=1);

use App\Livewire\Convenio\ReCobertura;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReCobertura::class)
        ->assertStatus(200);
});
