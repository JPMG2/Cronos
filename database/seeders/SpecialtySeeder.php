<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialist = [
            ['specialty_name' => 'Cardiología'],
            ['specialty_name' => 'Dermatología'],
            ['specialty_name' => 'Endocrinología'],
            ['specialty_name' => 'Gastroenterología'],
            ['specialty_name' => 'Geriatría'],
            ['specialty_name' => 'Ginecología'],
            ['specialty_name' => 'Hematología'],
            ['specialty_name' => 'Infectología'],
            ['specialty_name' => 'Medicina General'],
            ['specialty_name' => 'Medicina Interna'],
            ['specialty_name' => 'Medicina Laboral'],
            ['specialty_name' => 'Medicina Legal'],
            ['specialty_name' => 'Nefrología'],
            ['specialty_name' => 'Neumología'],
            ['specialty_name' => 'Neurología'],
            ['specialty_name' => 'Oftalmología'],
            ['specialty_name' => 'Oncología'],
            ['specialty_name' => 'Pediatría'],
            ['specialty_name' => 'Psiquiatría'],
            ['specialty_name' => 'Reumatología'],
            ['specialty_name' => 'Traumatología'],
            ['specialty_name' => 'Urología'],
        ];

        foreach ($specialist as $specialty) {
            Specialty::create($specialty);
        }
    }
}
