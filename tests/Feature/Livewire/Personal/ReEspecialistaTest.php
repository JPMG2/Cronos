<?php

declare(strict_types=1);

use App\Livewire\Personal\ReEspecialista;
use App\Models\Medical;

use function Pest\Livewire\livewire;

beforeEach(function (): void {

    $this->user = loginUser();
    $this->actingAs($this->user);
    createRolesAndActions($this->user);
    createHeaderMenu('Especialistas', 'Registro/Personal/Especialistas');
});

it('renders ReEspecialista form correctly with initial state', function (): void {
    $component = livewire(ReEspecialista::class)
        ->assertStatus(200)
        ->assertViewIs('livewire.personal.re-especialista')
        ->assertViewHas(['listState', 'listSpecialties', 'listDegree', 'listCredential']);

    expect($component->isupdate)->toBeFalse()
        ->and($component->formesp->dataespecialist)->toBeArray();
});

it('checks if form has required attributes', function (Closure $fields): void {
    $fields = $fields();
    $component = livewire(ReEspecialista::class);
    $arrayAtributtes = $component->formesp->dataespecialist;
    expect(array_keys($arrayAtributtes))->toEqual(array_keys($fields));
})->with('required fields');

it('fails when fields are missing', function (array $params): void {
    $data = $params['data'];
    $files = $params['fields'];
    $component = livewire(ReEspecialista::class);
    $component->set('formesp.dataespecialist', $data);
    $component->call('getEspecialis')
        ->assertHasErrors($files);

})->with('fields missing');

it('creates a new Medic successfully', function (Closure $dataFactory): void {
    $data = $dataFactory();
    $component = livewire(ReEspecialista::class);
    $component->set('formesp.dataespecialist', $data);

    $expectedName = ucwords(mb_strtolower(mb_trim((string) $data['medical_name'])));

    $component->call('getEspecialis');
    $nameCreate = Medical::latest()->first()->medical_name;

    expect($nameCreate)->toBe($expectedName);
})->with('especilist info');
