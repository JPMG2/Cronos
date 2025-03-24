<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Seeder;

final class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nationality = [
            ['nationality_name' => 'Argentino'],
            ['nationality_name' => 'Boliviano'],
            ['nationality_name' => 'Brasileño'],
            ['nationality_name' => 'Chileno'],
            ['nationality_name' => 'Colombiano'],
            ['nationality_name' => 'Costarricense'],
            ['nationality_name' => 'Cubano'],
            ['nationality_name' => 'Ecuatoriano'],
            ['nationality_name' => 'Salvadoreño'],
            ['nationality_name' => 'Guatemalteco'],
            ['nationality_name' => 'Hondureño'],
            ['nationality_name' => 'Mexicano'],
            ['nationality_name' => 'Nicaragüense'],
            ['nationality_name' => 'Panameño'],
            ['nationality_name' => 'Paraguayo'],
            ['nationality_name' => 'Peruano'],
            ['nationality_name' => 'Puertorriqueño'],
            ['nationality_name' => 'Dominicano'],
            ['nationality_name' => 'Uruguayo'],
            ['nationality_name' => 'Venezolano'],

        ];
        foreach ($nationality as $data) {
            Nationality::create($data);
        }
    }
}
