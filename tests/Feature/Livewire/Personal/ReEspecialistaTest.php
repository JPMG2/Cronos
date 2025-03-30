<?php

declare(strict_types=1);

use App\Livewire\Personal\ReEspecialista;
use App\Models\Medical;

use function Pest\Livewire\livewire;

beforeEach(function () {

    $this->user = loginUser();
    $this->actingAs($this->user);
    createRolesAndActions($this->user);
    createHeaderMenu('Especialistas', 'Registro/Personal/Especialistas');
});

it('renders the ReEspecialista form correctly', function () {
    $this->actingAs($this->user);
    livewire(ReEspecialista::class)
        ->assertStatus(200);
});

it('checks if form has required attributes', function (Closure $fields) {
    $fields = $fields();
    $this->actingAs($this->user);
    $component = livewire(ReEspecialista::class);
    $arrayAtributtes = $component->formesp->dataespecialist;
    expect(array_keys($arrayAtributtes))->toEqual(array_keys($fields));
})->with('required fields');

it('creates a new Medic successfully', function (Closure $dataFactory) {
    $data = $dataFactory();
    $this->actingAs($this->user);
    $component = livewire(ReEspecialista::class);
    $component->set('formesp.dataespecialist', $data);
    $nameMedic = $component->formesp->dataespecialist['medical_name'];
    $component->call('getEspecialis');
    $nameCreate = Medical::latest()->first()->medical_name;
    expect($nameCreate)->toBe($nameMedic);
})->with('especilist info');
