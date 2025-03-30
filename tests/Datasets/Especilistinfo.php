<?php

declare(strict_types=1);

use App\Models\Credential;
use App\Models\Degree;
use App\Models\Specialty;
use App\Models\State;

use function Pest\Faker\fake;

dataset('especilist info', function () {
    return [
        fn () => [
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
        ],
    ];
});
dataset('required fields', function () {
    return [
        fn () => [
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
        ],
    ];
});
