<?php

declare(strict_types=1);

use App\Livewire\Convenio\PlanCoverageConfig;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(PlanCoverageConfig::class)
        ->assertStatus(200);
});
