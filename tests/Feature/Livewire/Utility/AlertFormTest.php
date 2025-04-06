<?php

declare(strict_types=1);

use App\Livewire\Utility\AlertForm;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(AlertForm::class)
        ->assertStatus(200);
});
