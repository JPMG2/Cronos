<?php

use App\Livewire\Utility\AlertForm;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(AlertForm::class)
        ->assertStatus(200);
});
