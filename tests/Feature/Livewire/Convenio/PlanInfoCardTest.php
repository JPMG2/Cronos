<?php

declare(strict_types=1);

use App\Livewire\Convenio\PlanInfoCard;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(PlanInfoCard::class)
        ->assertStatus(200);
});
