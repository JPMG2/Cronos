<?php

declare(strict_types=1);

use App\Livewire\Convenio\ReInsurancePlan;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReInsurancePlan::class)
        ->assertStatus(200);
});
