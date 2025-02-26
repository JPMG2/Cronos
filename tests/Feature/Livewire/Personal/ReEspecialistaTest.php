<?php

use App\Livewire\Personal\ReEspecialista;
use App\Models\Credential;
use App\Models\Degree;
use App\Models\Medical;
use App\Models\Specialty;
use App\Models\State;

use function Pest\Faker\fake;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->user = loginUser();
    createRolesAndActions($this->user);
    createHeaderMenu('Especialistas', 'Registro/Personal/Especialistas');
});
function especialistaMainAttributes(): array
{
    return [
        'state_id' => 1,
        'credential_id' => '',
        'specialty_id' => null,
        'degree_id' => null,
        'medical_name' => '',
        'medical_lastname' => '',
        'medical_address' => '',
        'medical_phone' => '',
        'medical_email' => '',
        'medical_dni' => '',
        'medical_codenumber' => '',
    ];
}
function dataEspecialist(): array
{
    return [
        'state_id' => State::factory()->create()->id,
        'credential_id' => Credential::factory()->create()->id,
        'specialty_id' => Specialty::factory()->create()->id,
        'degree_id' => Degree::factory()->create()->id,
        'medical_name' => fake()->name,
        'medical_lastname' => fake()->lastName,
        'medical_address' => fake()->address,
        'medical_phone' => fake()->randomNumber(9, true),
        'medical_email' => fake()->email,
        'medical_dni' => fake()->randomNumber(9, true),
        'medical_codenumber' => fake()->numerify('######'),
    ];
}
it('renders the ReEspecialista form correctly', function () {
    $this->actingAs($this->user);
    livewire(ReEspecialista::class)
        ->assertStatus(200);
});
it('checks if form has required attributes', function () {
    $this->actingAs($this->user);
    $component = livewire(ReEspecialista::class);
    $arrayAtributtes = $component->formesp->dataespecialist;
    expect(array_keys($arrayAtributtes))->toEqual(array_keys(especialistaMainAttributes()));
});
it('creates a new Medic successfully', function () {
    $this->actingAs($this->user);
    $component = livewire(ReEspecialista::class);
    $component->set('formesp.dataespecialist', dataEspecialist());
    $nameMedic = $component->formesp->dataespecialist['medical_name'];
    $component->call('getEspecialis');
    $nameCreate = Medical::latest()->first()->medical_name;
    expect($nameCreate)->toBe($nameMedic);
});
