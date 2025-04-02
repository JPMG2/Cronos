<?php

declare(strict_types=1);

use App\Livewire\Personal\ReEspecialista;
use App\Models\Medical;
use App\Traits\FormActionsTrait;
use App\Traits\HandlesActionPolicy;
use App\Traits\UtilityForm;

use function Pest\Livewire\livewire;

beforeEach(function () {

    $this->user = loginUser();
    $this->actingAs($this->user);
    createRolesAndActions($this->user);
    createHeaderMenu('Especialistas', 'Registro/Personal/Especialistas');
});

it('renders  ReEspecialista form correctly', function () {
    livewire(ReEspecialista::class)
        ->assertStatus(200);
});

it('checks if form has required attributes', function (Closure $fields) {
    $fields = $fields();
    $component = livewire(ReEspecialista::class);
    $arrayAtributtes = $component->formesp->dataespecialist;
    expect(array_keys($arrayAtributtes))->toEqual(array_keys($fields));
})->with('required fields');

it('check if Traits are present', function () {
    $reflection = new ReflectionClass(ReEspecialista::class);
    $traits = $reflection->getTraitNames();

    expect($traits)->toContain(
        FormActionsTrait::class,
        HandlesActionPolicy::class,
        UtilityForm::class
    );

});

it('fails when fields are missing', function ($params) {
    $data = $params['data'];
    $files = $params['fields'];
    $component = livewire(ReEspecialista::class);
    $component->set('formesp.dataespecialist', $data);
    $component->call('getEspecialis')
        ->assertHasErrors($files);

})->with('fields missing');

it('creates a new Medic successfully', function (Closure $dataFactory) {
    $data = $dataFactory();
    $component = livewire(ReEspecialista::class);
    $component->set('formesp.dataespecialist', $data);
    $nameMedic = $component->formesp->dataespecialist['medical_name'];
    $component->call('getEspecialis');
    $nameCreate = Medical::latest()->first()->medical_name;
    expect($nameCreate)->toBe($nameMedic);
})->with('especilist info');
