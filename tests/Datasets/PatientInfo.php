<?php

declare(strict_types=1);

use App\Models\City;
use App\Models\Document;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Occupation;

use function Pest\Faker\fake;

dataset('paciente fields', function () {
    return [
        fn () => [
            'document_id' => 1,
            'city_id' => null,
            'gender_id' => 1,
            'occupation_id' => null,
            'marital_status_id' => null,
            'nationality_id' => null,
            'num_document' => '',
            'person_name' => '',
            'person_lastname' => '',
            'person_datebirth' => '',
            'person_phone' => '',
            'person_email' => '',
            'person_address' => '',
        ],
    ];
});

dataset('paciente missing fields', function () {
    return [
        fn () => [
            'data' => [
                'document_id' => Document::factory()->create()->id,
                'city_id' => City::factory()->create()->id,
                'gender_id' => Gender::factory()->create()->id,
                'occupation_id' => Occupation::factory()->create()->id,
                'marital_status_id' => MaritalStatus::factory()->create()->id,
                'nationality_id' => Nationality::factory()->create()->id,
                'num_document' => '',
                'person_name' => '',
                'person_lastname' => '',
                'person_datebirth' => '',
                'person_phone' => fake()->randomNumber(9, true),
                'person_email' => fake()->unique()->safeEmail(),
                'person_address' => fake()->streetAddress,
            ],

            'fields' => [
                'document_id',
                'person_name',
                'person_lastname',
                'num_document',
                'person_datebirth',
            ],
        ],
    ];
});
