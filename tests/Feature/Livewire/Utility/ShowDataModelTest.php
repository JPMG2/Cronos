<?php

declare(strict_types=1);

use App\Livewire\Utility\ShowDataModel;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ShowDataModel::class)
        ->assertStatus(200);
});
