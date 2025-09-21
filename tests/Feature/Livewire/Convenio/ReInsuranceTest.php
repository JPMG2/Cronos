<?php

declare(strict_types=1);

use App\Livewire\Convenio\ReInsurance;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReInsurance::class)
        ->assertStatus(200);
});
