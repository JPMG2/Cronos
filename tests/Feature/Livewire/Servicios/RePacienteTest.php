<?php

declare(strict_types=1);

use App\Livewire\Clinico\RePaciente;

use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->user = loginUser();
    $this->actingAs($this->user);
    createRolesAndActions($this->user);
    createHeaderMenu('Pacientes', 'Servicios/Clínico/Pacientes');
});

it('renders RePaciente form correctly', function () {
    livewire(RePaciente::class)
        ->assertStatus(200)
        ->assertViewIs('livewire.servicios.re-paciente');
});

it('checks if form has required attributes', function (Closure $fields) {
    $fields = $fields();
    $component = livewire(RePaciente::class);
    $arrayAtributes = $component->pacienteForm->pesonData;
    expect(array_keys($arrayAtributes))->toEqual(array_keys($fields));

})->with('paciente fields');

it('fails when fields are missing', function (array $params): void {
    $data = $params['data'];
    $files = $params['fields'];
    $component = livewire(RePaciente::class);
    $component->set('pacienteForm.pesonData', $data);
    $component->call('queryPaciente')
        ->assertHasErrors($files);
})->with('paciente missing fields');
