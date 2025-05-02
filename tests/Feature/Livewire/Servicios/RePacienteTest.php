<?php

declare(strict_types=1);

use App\Livewire\Servicios\RePaciente;

use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->user = loginUser();
    $this->actingAs($this->user);
    createRolesAndActions($this->user);
    createHeaderMenu('Pacientes', 'Servicios/Clínico/Pacientes');
});

it('renders RePaciente form correctly', function () {
    livewire(RePaciente::class)
        ->assertStatus(200);
});
