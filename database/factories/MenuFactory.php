<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
final class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'menu_id' => null,
            'name_menu' => fake()->word(),
            'grup_menu' => fake()->word(),
            'title_menu' => fake()->boolean,
            'icon_menu' => fake()->word(),
            'linkto' => fake()->word(),
            'header_menu' => fake()->word(),
            'descripcion' => fake()->text(100),
        ];
    }
}
