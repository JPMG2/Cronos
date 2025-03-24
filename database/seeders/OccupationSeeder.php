<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Seeder;

final class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ocupaccion = [
            ['occupation_name' => 'Doctor'],
            ['occupation_name' => 'Mantenimiento'],
            ['occupation_name' => 'Cocinero'],
            ['occupation_name' => 'Enfermero'],
            ['occupation_name' => 'Panadero'],
            ['occupation_name' => 'Secretaria'],
            ['occupation_name' => 'Contador'],
            ['occupation_name' => 'Ingeniero'],
            ['occupation_name' => 'Arquitecto'],
            ['occupation_name' => 'Abogado'],
            ['occupation_name' => 'Profesor'],
            ['occupation_name' => 'Estudiante'],
            ['occupation_name' => 'Farmacéutico'],
            ['occupation_name' => 'Jubilado'],
            ['occupation_name' => 'Desempleado'],
            ['occupation_name' => 'Otro'],
        ];
        foreach ($ocupaccion as $dataocupacion) {
            Occupation::create($dataocupacion);
        }
    }
}
