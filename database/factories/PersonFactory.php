<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Document;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Occupation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Person>
 */
final class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_id' => Document::factory(),
            'gender_id' => Gender::factory(),
            'marital_status_id' => MaritalStatus::factory(),
            'occupation_id' => Occupation::factory(),
            'nationality_id' => Nationality::factory(),
            'num_document' => (string) fake()->randomNumber(9, true),
            'person_name' => fake()->name(),
            'person_lastname' => fake()->lastName(),
            'person_address' => fake()->address(),
            'person_phone' => (string) fake()->randomNumber(6, true),
            'person_email' => fake()->unique()->safeEmail(),
            'person_datebirth' => fake()->dateTimeBetween(),

        ];
    }
}
