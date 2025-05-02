<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaritalStatus>
 */
final class MaritalStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maritalstatus_name' => fake()->randomElement(['Soltero', 'Casado', 'Divorciado', 'Viudo', 'Unión Libre']),
        ];
    }
}
