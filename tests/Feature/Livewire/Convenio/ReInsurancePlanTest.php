<?php

declare(strict_types=1);

use App\Livewire\Convenio\RePrestadorPlan;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(RePrestadorPlan::class)
        ->assertStatus(200);
});
